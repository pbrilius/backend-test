<?php

namespace Samknows\Model;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Description of AggregateModel
 *
 * @author paul
 */
class AggregateModel
{
    /**
     *
     * @var EntityRepository
     */
    private $dataPointRepository;

    /**
     * @var SymfonyStyle
     */
    private $io;

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
        $io = $this->getIo();
        $dataPointRepository->setIo($io);

        return $dataPointRepository->aggregate();
    }

    /**
     * @return SymfonyStyle
     */
    public function getIo(): SymfonyStyle
    {
        return $this->io;
    }

    /**
     * @param SymfonyStyle $io
     * @return AggregateModel
     */
    public function setIo(SymfonyStyle $io): AggregateModel
    {
        $this->io = $io;
        return $this;
    }

}
