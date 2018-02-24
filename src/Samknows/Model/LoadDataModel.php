<?php

namespace Samknows\Model;

use Samknows\Entity\DataPoint;
use Samknows\Repository\DataPoint;

/**
 * Description of LoadDataModel
 *
 * @author paul
 */
class LoadDataModel
{
    /**
     *
     * @var DataPoint
     */
    private $dataPointRepository;
    
    public function __construct(DataPoint $dataPointRepository)
    {
        $this->dataPointRepository = $dataPointRepository;
    }
    
    public function getDataPointRepository(): DataPoint
    {
        return $this->dataPointRepository;
    }

    public function setDataPointRepository($dataPointRepository)
    {
        $this->dataPointRepository = $dataPointRepository;
        return $this;
    }
    
    public function loadData($csvFile)
    {
        $dataPointRepository = $this->getDataPointRepository();
        $handle = fopen($csvFile, 'r');
        while ($dataEntry = fgetcsv($handle) !== null) {
            $dataPoint = new DataPoint();
            $dataPoint->setDownload($dataEntry['download']);
            $dataPoint->setUpload($dataEntry['upload']);
            $dataPoint->setLatency($dataEntry['latency']);
            $dataPoint->setPacketLoss($dataEntry['packet_loss']);
            $dataPoint->setUnitId($dataEntry['unit_id']);
            $dataPoint->setTimestamp((new \DateTime())->format('Y-m-d H:i:s'));
            $dataPointRepository->persist($dataPoint);
        }
    }

}
