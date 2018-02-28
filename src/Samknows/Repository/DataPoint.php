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
        var_dump($qb->getDQL());
//        echo 'test cp 6';
//        $qb->groupBy('dp.unitId,'
//            . ' formatted_date'
//        );
//        echo 'test cp 8';
//        $qb->orderBy('dp.unitId,'
//            . ' formatted_date'
//        );
//        echo 'test cp 7';
//        var_dump($qb->getDQL());
        $aggregatedFields = $qb
            ->getQuery()
            ->getArrayResult();
//        var_dump($aggregatedFields);
//        $qb->resetDQLParts();
//        $qb = $this->initAggregateQueryBuilder();
        foreach ($aggregatedFields as $row) {
            var_dump($row);
            $aggregatedDataPoints = new AggregatedDataPoints();
            foreach ($row as $fieldName => $field) {
                var_dump($fieldName);
                var_dump($field);
                switch ($fieldName) {
                    case 'formatted_date':
                        continue;
                        break;
                    case 'unitId':
                        $aggregatedDataPoints->setUnitId($field);
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
                        ], $field);
                        break;
                }
                var_dump((array) $aggregatedDataPoints);
            }
        }
        return;
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
                var_dump($metric);
                var_dump($formattedMetric);
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
                var_dump($result);
//                var_dump($unsupportedIndicator);
//                exit;
                $unsupportedIndicatorsAggregation[strtolower($unsupportedIndicator)][$metric] = $result;
            }
        }

        foreach ($unsupportedIndicatorsAggregation as $metric) {

        }
//        var_dump($unsupportedIndicatorsAggregation);
//        return;
        $groupedUnsupportedIndicators = [];
        foreach ($unsupportedIndicatorsAggregation as $indicator => $metrics) {
//            var_dump($indicator);
//            var_dump(array_keys($metrics));
//            exit;
            foreach ($metrics as $metric => $data) {
//                var_dump('metric');
//                var_dump($metric);
                foreach ($data as $row) {
//                    var_dump('keys');
//                    var_dump(array_keys($row));
//                    var_dump($row[array_keys($row)[2]]);
//                                        continue;
                    $groupedUnsupportedIndicators[$indicator][$metric][$row['unitId']]
                    [$row['formatted_date']][] = $row[array_keys($row)[2]];
                }
            }
        }

        var_dump($groupedUnsupportedIndicators);
//        die;
    }
}
