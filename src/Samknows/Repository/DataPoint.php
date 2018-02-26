<?php

namespace Samknows\Repository;

use Samknows\Repository\QueryBuilder\DataPoint as DataPointRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr;

/**
 * Description of DataPoint
 *
 * @author paul
 */
class DataPoint extends DataPointRepository
{
    private function initAggregateQueeryBuilder()
    {
        /* @var $qb QueryBuilder */
        $qb = $this->createQueryBuilder('dp');
        $qb->select("DATE_FORMAT(dp.timestamp, '%H') AS formatted_date");
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
        $qb = $this->initAggregateQueeryBuilder();

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
                    . '_' . $metric);
            }
        }
        var_dump($qb->getDQL());
        echo 'test cp 6';
        $qb->groupBy('dp.unitId,'
            . ' formatted_date'
        );
        echo 'test cp 8';
        $qb->orderBy('dp.unitId,'
            . ' formatted_date'
        );
        echo 'test cp 7';
//        var_dump($qb->getDQL());
        $aggregatedFields = $qb
            ->getQuery()
            ->getArrayResult();

        $qb = $this->initAggregateQueeryBuilder();
        foreach (\Samknows\DOCTRINE_UNSUPPORTED_INDICATORS as $unsupportedIndicator) {
            foreach (\Samknows\METRICS as $metric) {
                $qb->addSelect('dp.' . $metric . ' AS ' . strtolower($unsupportedIndicator) . '_stage_1');
            }
        }
        $qb->group

        $result = $qb
            ->getQuery()
            ->getArrayResult();

        foreach ($result as $row) {
            $aggregatedFields []= '';
        }
    }
}
