<?php

namespace Samknows\Model;

use Samknows\Repository\AggregatedDataPoints;

/**
 * Description of SearchModel
 *
 * @author paul
 */
class SearchModel
{
    /**
     *
     * @var AggregatedDataPoints
     */
    private $aggregatedDataPointsRepository;
    
    public function __construct(AggregatedDataPoints $aggregatedDataPointsRepository)
    {
        $this->aggregatedDataPointsRepository = $aggregatedDataPointsRepository;
    }
    
    public function getAggregatedDataPointsRepository(): AggregatedDataPoints
    {
        return $this->aggregatedDataPointsRepository;
    }

    public function setAggregatedDataPointsRepository($aggregatedDataPointsRepository)
    {
        $this->aggregatedDataPointsRepository = $aggregatedDataPointsRepository;
        return $this;
    }

    public function search($conditions)
    {
        $aggregatedDataPointsRepository = $this->getAggregatedDataPointsRepository();
        $aggregatedDataPointsRepository->search($conditions);
    }

}
