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
        $aggregatedDataPointsRepository->findBy($criteria);
    }

}
