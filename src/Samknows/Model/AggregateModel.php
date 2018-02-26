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
    private $dataPointRepository;

    public function __construct(EntityRepository $dataPointRepository)
    {
        $this->dataPointRepository = $dataPointRepository;
    }
    
    public function getDataPointRepository(): EntityRepository
    {
        return $this->dataPointRepository;
    }

    public function setDataPointRepository(EntityRepository $dataPointRepository)
    {
        $this->dataPointRepository = $dataPointRepository;
        return $this;
    }

    public function aggregateDataPoints()
    {
        /* @var \Samknows\Repository\DataPoint $dataPointRepository */
        $dataPointRepository = $this->getDataPointRepository();
        return $dataPointRepository->aggregate();
    }
    
}
