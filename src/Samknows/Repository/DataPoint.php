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
                        $fieldParts = explode('_', $fieldName);
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
//        return;
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
                var_dump('aggregate stage 2 test');
                $qb->resetDQLParts(['groupBy']);
                $qb->addOrderBy(new Expr\OrderBy($metric
                    . '_' . strtolower($unsupportedIndicator)
                    . '_stage_1', 'ASC'));
                var_dump($qb->getDQL());
//                exit;
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
        var_dump('$groupedUnsupportedIndicators');
//        var_dump(array_keys($groupedUnsupportedIndicators));
//        return;
        $aggregatedUnsuppotedIndicators = [];
        foreach ($groupedUnsupportedIndicators as $unsupportedIndicator => $metrics) {
            var_dump('$unsupportedIndicator');
            var_dump($unsupportedIndicator);
//            continue;
            foreach ($metrics as $metric => $metricData) {
                var_dump('$metric');
                var_dump($metric);
                var_dump('$metricData');
                var_dump($metricData);
//                continue;
                foreach ($metricData as $unit => $unitData) {
                    var_dump('$unit');
                    var_dump($unit);
//                    continue;
                    foreach ($unitData as $formattedDate => $hourData) {
                        var_dump('formattedDate');
                        var_dump($formattedDate);
                        var_dump('$hourData');
                        var_dump($hourData);
//                        continue;
                        $size = count($hourData);
                        var_dump('$metric test');
                        var_dump($aggregatedUnsuppotedIndicators[$unsupportedIndicator]);
                        var_dump('test data indexes');
                        var_dump(array_keys($aggregatedUnsuppotedIndicators));
                        var_dump($aggregatedUnsuppotedIndicators[$unsupportedIndicator]);
                        var_dump($aggregatedUnsuppotedIndicators[$unsupportedIndicator][$metric]);
                        var_dump($aggregatedUnsuppotedIndicators[$unsupportedIndicator][$metric][$unit]);
                        var_dump($aggregatedUnsuppotedIndicators[$unsupportedIndicator][$metric][$unit][$formattedDate]);
//                        continue;
                        var_dump('offset types test');
                        var_dump($unsupportedIndicator);
                        var_dump($metric);
                        var_dump($unit);
                        var_dump($formattedDate);
                        if ($size % 2 == 0) {
                            $aggregatedUnsuppotedIndicators[$unsupportedIndicator][$metric][$unit][$formattedDate] = 'test a1';
                            $aggregatedUnsuppotedIndicators[$unsupportedIndicator][$metric][$unit][$formattedDate]
                                = round(($hourData[(floor($size / 2))] + $hourData[ceil($size / 2)]) / 2, 2);
                        } else {
                            $aggregatedUnsuppotedIndicators[$unsupportedIndicator][$metric][$unit][$formattedDate] = 'test a2';
                                = $hourData[$size / 2];
                        }
                        $aggregatedDataPoints = $em
                            ->getRepository(AggregatedDataPoints::class)
                            ->findOneBy([
                                'unitId' => $unit,
                                'hour' => $formattedDate
                            ]);
                        $em
                            ->persist($aggregatedDataPoints)
                            ->flush();
                    }
                }
            }
        }

        foreach ($aggregatedUnsuppotedIndicators as $indicator) {
            foreach ($indicator as $metric) {
//                $formattedMetric = '';
//                $metricParts = explode('_', $metric);
//                for ($i = 1; $i < count($metricParts); $i++) {
//                    $formattedMetric .= mb_convert_case($metricParts[$i], MB_CASE_TITLE);
//                }
//                $formattedMetric = $metricParts[0] . $formattedMetric;
//                var_dump($metric);
//                var_dump($formattedMetric);
                foreach ($metric as $unit) {
                    foreach ($unit as $formattedDate => $parameter) {
                        $aggregatedDataPoints = $this->findOneBy([
                            'unitId' => $unit
                        ]);
                        call_user_func([
                            $aggregatedDataPoints,
                            'set'
                            . $metric
                            . $indicator
                        ], is_null($parameter) ? 0 : $parameter);
                        var_dump((array) $aggregatedDataPoints);
                    }
                }
            }
        }

//        var_dump($groupedUnsupportedIndicators);
//        die;
    }
}
