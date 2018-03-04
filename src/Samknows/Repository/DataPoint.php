<?php

namespace Samknows\Repository;

use Doctrine\Common\Collections\ExpressionBuilder;
use Doctrine\ORM\Query\Expr;
use Samknows\Repository\QueryBuilder\DataPoint as DataPointRepository;
use Samknows\Entity\AggregatedDataPoints;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Common\Collections\Criteria;

/**
 * Description of DataPoint
 *
 * @author paul
 */
class DataPoint extends DataPointRepository
{
    private function initAggregateQueryBuilder()
    {
        /* @var $qb QueryBuilder */
        $qb = $this->createQueryBuilder('dp');
        $qb
            ->select("DATE_FORMAT(dp.timestamp, '%H') AS formatted_date")
            ->addSelect('dp.unitId');
        $qb->groupBy('dp.unitId,'
            . ' formatted_date'
        );
        echo 'test cp 8';
        $qb->orderBy('dp.unitId,'
            . ' formatted_date'
        );
        return $qb;
    }

    public function aggregate()
    {
        $qb = $this->initAggregateQueryBuilder();

        foreach (\Samknows\DOCTRINE_SUPPORTED_INDICATORS as $indicator) {
            foreach (\Samknows\METRICS as $metric) {
                $formattedMetric = '';
                $metricParts = explode('_', $metric);
                for ($i = 1; $i < count($metricParts); $i++) {
                    $formattedMetric .= mb_convert_case($metricParts[$i], MB_CASE_TITLE);
                }
                $formattedMetric = $metricParts[0] . $formattedMetric;
                $qb->addSelect($indicator . '(dp.' . $formattedMetric. ') AS '
                    . strtolower($indicator)
                    . '_' . $metric
                );
            }
        }
        $qb->addSelect('COUNT(dp.id) AS sample_size');
        $aggregatedFields = $qb
            ->getQuery()
            ->getArrayResult();
        $em = $this->getEntityManager();
        foreach ($aggregatedFields as $row) {
            $aggregatedDataPoints = new AggregatedDataPoints();
//            var_dump($row);
//            die;
            foreach ($row as $fieldName => $field) {
                switch ($fieldName) {
                    case 'formatted_date':
                        $aggregatedDataPoints->setHour($field);
                        break;
                    case 'unitId':
                        $aggregatedDataPoints->setUnitId($field);
                        break;
                    case 'sample_size':
                        $aggregatedDataPoints->setSampleSize($field);
                        break;
                    default:
                        preg_match(\Samknows\METRICS_TYPES_REGEX[\Samknows\TYPE_FLOAT], $fieldName, $matches);
                        if (!empty($matches)) {
                            $field = number_format((float) $field,
                                \Samknows\FLOAT_FORMAT_DECIMALS,
                                \Samknows\FLOAT_DECIMALS_POINT,
                                \Samknows\FLOAT_THOUSANDS_SEPARATOR);
                        }
                        $fieldParts = explode('_' , $fieldName);
                        $indicator = $fieldParts[0];
                        $metric = '';
                        for ($a = 1; $a < count($fieldParts); $a++) {
                            $metric .= mb_convert_case($fieldParts[$a], MB_CASE_TITLE);
                        }
                        call_user_func([
                            $aggregatedDataPoints,
                            'set'
                            . $metric
                            . $indicator
                        ], is_null($field) ? 0 : $field);
                        break;
                }
            }
            try {
                $em->persist($aggregatedDataPoints);
                $em->flush();
            } catch (\Exception $e) {
                echo $e->getMessage() . "\n";
                continue;
            }
        }
        $doctrineUnsupportedIndicators = array_diff(\Samknows\INDICATORS,
            \Samknows\DOCTRINE_SUPPORTED_INDICATORS);
        $unsupportedIndicatorsAggregation = [];
        foreach ($doctrineUnsupportedIndicators as $unsupportedIndicator) {
            foreach (\Samknows\METRICS as $metric) {
                $qb = $this->initAggregateQueryBuilder();
                $formattedMetric = '';
                $metricParts = explode('_', $metric);
                for ($i = 1; $i < count($metricParts); $i++) {
                    $formattedMetric .= mb_convert_case($metricParts[$i], MB_CASE_TITLE);
                }
                $formattedMetric = $metricParts[0] . $formattedMetric;
                $qb->addSelect('dp.'
                    . $formattedMetric
                    . ' AS '
                    . $metric
                    . '_' . strtolower($unsupportedIndicator)
                    . '_stage_1'
                );
                /* @var $criteriaExpression ExpressionBuilder */
                $criteriaExpression = Criteria::expr();
                $criteria = Criteria::create()
                    ->where($criteriaExpression->neq($formattedMetric, null));
                $qb->addCriteria($criteria);
                $qb->resetDQLParts(['groupBy']);
                $qb->addOrderBy(new Expr\OrderBy($metric
                    . '_' . strtolower($unsupportedIndicator)
                    . '_stage_1', 'ASC'));
                $result = $qb
                    ->getQuery()
                    ->getArrayResult();
                $unsupportedIndicatorsAggregation[strtolower($unsupportedIndicator)][$metric] = $result;
            }
        }
        $groupedUnsupportedIndicators = [];
        foreach ($unsupportedIndicatorsAggregation as $indicator => $metrics) {
            foreach ($metrics as $metric => $data) {
                foreach ($data as $row) {
                    $groupedUnsupportedIndicators[$indicator][$metric][$row['unitId']]
                    [$row['formatted_date']][] = $row[array_keys($row)[2]];
                }
            }
        }
        $aggregatedUnsuppotedIndicators = [];
        foreach ($groupedUnsupportedIndicators as $unsupportedIndicator => $metrics) {
            foreach ($metrics as $metric => $metricData) {
                foreach ($metricData as $unit => $unitData) {
                    foreach ($unitData as $formattedDate => $hourData) {
                        $size = count($hourData);
                        if ($size % 2 == 0) {
                            $aggregatedUnsuppotedIndicators[$unsupportedIndicator][$metric][$unit][$formattedDate]
                                = round(($hourData[(floor($size / 2))] + $hourData[ceil($size / 2)]) / 2, 2);
                        } else {
                            $aggregatedUnsuppotedIndicators[$unsupportedIndicator][$metric][$unit][$formattedDate] = $hourData[$size / 2];
                        }
                    }
                }
            }
        }

        foreach ($aggregatedUnsuppotedIndicators as $indicator => $metrics) {
            foreach ($metrics as $metric => $metricData) {
                foreach ($metricData as $unit => $unitData) {
                    foreach ($unitData as $formattedDate => $parameter) {
                        $aggregatedDataPoints = $em
                            ->getRepository(AggregatedDataPoints::class)
                            ->findOneBy([
                                'unitId' => $unit,
                                'hour' => $formattedDate,
                            ]);
                        if (empty($aggregatedDataPoints)) {
                            $aggregatedDataPoints = new AggregatedDataPoints();
                            $aggregatedDataPoints->setUnitId($unit);
                            $aggregatedDataPoints->setHour($formattedDate);
                        }
                        $formattedMetric = '';
                        $metricParts = explode('_', $metric);
                        for ($i = 0; $i < count($metricParts); $i++) {
                            $formattedMetric .= mb_convert_case($metricParts[$i], MB_CASE_TITLE);
                        }
                        $setter = 'set' . $formattedMetric . mb_convert_case($indicator, MB_CASE_TITLE);
                        call_user_func([
                            $aggregatedDataPoints,
                            $setter
                        ], is_null($parameter) ? 0 : $parameter);
                        if ($aggregatedDataPoints->getId()) {
                            $em->flush();
                        } else {
                            $em
                                ->persist()
                                ->flush();
                        }
                    }
                }
            }
        }
    }
}
