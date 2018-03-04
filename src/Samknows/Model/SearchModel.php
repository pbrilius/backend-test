<?php

namespace Samknows\Model;

use Doctrine\ORM\EntityRepository;
use Samknows\Entity\AggregatedDataPoints;

/**
 * Description of SearchModel
 *
 * @author paul
 */
class SearchModel
{
    /**
     *
     * @var EntityRepository
     */
    private $aggregatedDataPointsRepository;
    
    public function __construct(EntityRepository $aggregatedDataPointsRepository)
    {
        $this->aggregatedDataPointsRepository = $aggregatedDataPointsRepository;
    }
    
    public function getAggregatedDataPointsRepository(): EntityRepository
    {
        return $this->aggregatedDataPointsRepository;
    }

    public function setAggregatedDataPointsRepository($aggregatedDataPointsRepository)
    {
        $this->aggregatedDataPointsRepository = $aggregatedDataPointsRepository;
        return $this;
    }

    public function search($criteria)
    {
        $aggregatedDataPointsRepository = $this->getAggregatedDataPointsRepository();
        $metric = $criteria['metric'];
        unset($criteria['metric']);
        $criteria['unitId'] = $criteria['unit'];
        unset($criteria['unit']);
        $metrics = $aggregatedDataPointsRepository->findBy($criteria);
        $filteredMetrics = [];
        /* @var $row AggregatedDataPoints */
        foreach ($metrics as $row) {
            $filteredMetricsRow = [
                'unitId' => $row->getUnitId(),
                'hour' => (int) $row->getHour() + 1,
            ];
            foreach (\Samknows\INDICATORS as $indicator) {
                $formattedMetric = '';
                $metricParts = explode('_', $metric);
                for ($i = 1; $i < count($metricParts); $i++) {
                    $formattedMetric .= mb_convert_case($metricParts[$i], MB_CASE_TITLE);
                }
                $formattedMetric = $metricParts[0] . $formattedMetric;
                $getter = 'get' . mb_convert_case($formattedMetric , MB_CASE_TITLE) . mb_convert_case($indicator, MB_CASE_TITLE);
                $field = call_user_func([$row, $getter]);
                preg_match(\Samknows\METRICS_TYPES_REGEX[\Samknows\TYPE_FLOAT_GETTER], $getter,  $matches);
                if (!empty($matches)) {
                    $field = number_format($field,
                        \Samknows\FLOAT_FORMAT_DECIMALS,
                        \Samknows\FLOAT_DECIMALS_POINT,
                        \Samknows\FLOAT_THOUSANDS_SEPARATOR
                    );
                }
                $filteredMetricsRow[$metric . mb_convert_case($indicator, MB_CASE_TITLE)] = $field;
            }
            $filteredMetricsRow['sampleSize'] = $row->getSampleSize();
            $filteredMetrics[] = $filteredMetricsRow;
        }

        return $filteredMetrics;
    }

}
