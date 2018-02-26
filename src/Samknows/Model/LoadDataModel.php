<?php

namespace Samknows\Model;

use Samknows\Entity\DataPoint as DataPointEntity;
use Doctrine\ORM\EntityManager;

/**
 * Description of LoadDataModel
 *
 * @author paul
 */
class LoadDataModel
{
    /**
     *
     * @var EntityManager
     */
    private $entityManager;
    private $documentRoot;
    
    public function __construct(EntityManager $entityManager,
            $documentRoot)
    {
        $this->entityManager = $entityManager;
        $this->documentRoot = $documentRoot;
    }
    
    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }

    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }
    
    public function loadData($fileName)
    {
        $entityManager = $this->getEntityManager();
        var_dump(get_class($entityManager));
        $em = $entityManager->getEntityManager();
        var_dump(get_class($em));
        die;
        var_dump('$documentRoot');
        var_dump($this->documentRoot . '/' . $fileName);
//        $handle = fopen($this->documentRoot . '/' . $fileName, 'r');
//        var_dump($handle);
        $decodedData = json_decode(file_get_contents($this->documentRoot . '/' . $fileName));
//        var_dump($decodedData);
        var_dump($decodedData[1]);
        var_dump($decodedData[2]);
        foreach ($decodedData as $unit) {
//            var_dump($unit);
//            die;
            foreach (\Samknows\METRICS as $metricsUnit) {
                foreach ($unit->metrics->{$metricsUnit} as $dataEntry) {
                    $dataPoint = new DataPointEntity();
                    call_user_func([$dataPoint, 'set' . mb_convert_case($metricsUnit, MB_CASE_TITLE)],
                        $dataEntry->value);
                    $dataPoint->setTimestamp($dataEntry->timestamp);
                    $entityManager->persist($dataPoint);
                    $entityManager->flush();
                    continue;
                    $dataPoint->setDownload($dataEntry->download);
                    $dataPoint->setUpload($dataEntry->upload);
                    $dataPoint->setLatency($dataEntry->latency);
                    $dataPoint->setPacketLoss($dataEntry->packet_loss);
                    $dataPoint->setUnitId($unit->unit_id);
                    $dataPoint->setTimestamp((new \DateTime())->format('Y-m-d H:i:s'));
                }
            }
//            foreach ($unit->metrics as $dataEntry) {
//                var_dump($dataEntry);
//                die;
//                
//            }
        }
        return;
        while (($dataEntry = fgetcsv($handle)) !== null) {
            var_dump($dataEntry);
            continue;
            
        }
    }
    
    public function setDocumentRoot($documentRoot)
    {
        $this->documentRoot = $documentRoot;
    }
    
    public function getDocumentRoot()
    {
        return $this->documentRoot;
    }

}
