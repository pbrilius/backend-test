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
        $decodedData = json_decode(file_get_contents($this->documentRoot . '/' . $fileName));
        foreach ($decodedData as $unit) {
            foreach (\Samknows\METRICS as $metricsUnit) {
                foreach ($unit->metrics->{$metricsUnit} as $dataEntry) {
                    $dataPoint = new DataPointEntity();
                    call_user_func([$dataPoint, 'set' . str_replace('_', '', mb_convert_case($metricsUnit, MB_CASE_TITLE))],
                        $dataEntry->value);
                    $dataPoint->setUnitId($unit->unit_id);
                    $dataPoint->setTimestamp(new \DateTime($dataEntry->timestamp));
                    try {
                        $entityManager->persist($dataPoint);
                        $entityManager->flush();
                    } catch (\Exception $e) {
                        echo $e->getMessage() . "\n";
                        continue;
                    }
                }
            }
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
