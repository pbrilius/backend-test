<?php

namespace Samknows\Model;

use Samknows\Repository\AggregatedDataPoints;

/**
 * Description of AggregateModel
 *
 * @author paul
 */
class AggregateModel
{
    /**
     *
     * @var type AggregatedDataPoints
     */
    private $aggregatedRepository;

    public function __construct(AggregatedDataPoints $aggregatedRepository)
    {
        $this->aggregatedRepository = $aggregatedRepository;
    }
    
    public function getAggregatedRepository(): AggregatedDataPoints
    {
        return $this->aggregatedRepository;
    }

    public function setAggregatedRepository(type $aggregatedRepository)
    {
        $this->aggregatedRepository = $aggregatedRepository;
        return $this;
    }

    public function aggregateDataPoints()
    {
        $aggregateRepository = $this->getAggregatedRepository();
        $aggregateRepository->aggregate();
    }
    
}
