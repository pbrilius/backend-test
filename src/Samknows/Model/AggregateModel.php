<?php

namespace Samknows\Model;

use Doctrine\ORM\EntityRepository;

/**
 * Description of AggregateModel
 *
 * @author paul
 */
class AggregateModel
{
    /**
     *
     * @var type EntityRepository
     */
    private $aggregatedRepository;

    public function __construct(EntityRepository $aggregatedRepository)
    {
        $this->aggregatedRepository = $aggregatedRepository;
    }
    
    public function getAggregatedRepository(): EntityRepository
    {
        return $this->aggregatedRepository;
    }

    public function setAggregatedRepository(EntityRepository $aggregatedRepository)
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
