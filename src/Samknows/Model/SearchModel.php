<?php

namespace Samknows\Model;

use Doctrine\ORM\EntityRepository;

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
        array_pop($criteria);
        $metrics = $aggregatedDataPointsRepository->findBy($criteria);
        $filteredMetrics = [];
        foreach ($metrics as $row) {
            $filteredMetricsRow = [
                'hour' => $row['hour'],
            ];
            foreach (\Samknows\METRICS as $metric) {
                $filteredMetricsRow[$metric] = $row[$criteria['metric'] . mb_convert_encoding($metric, MB_CASE_TITLE)];
            }
            $filteredMetrics[] = $filteredMetricsRow;
        }

        return $filteredMetrics;
    }

}
