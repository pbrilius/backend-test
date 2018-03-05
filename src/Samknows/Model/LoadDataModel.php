<?php

namespace Samknows\Model;

use Samknows\Entity\DataPoint as DataPointEntity;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Style\SymfonyStyle;

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

    /**
     * @var string
     */
    private $documentRoot;

    /**
     * @var SymfonyStyle
     */
    private $io;

    /**
     * LoadDataModel constructor.
     * @param EntityManager $entityManager
     * @param string $documentRoot
     * @param SymfonyStyle $io
     */
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
        $dataPointsSum = 0;
        foreach ($decodedData as $unit) {
            foreach (\Samknows\METRICS as $metricsUnit) {
                $dataPointsSum += count($unit->metrics->{$metricsUnit});
            }
        }
        $progressStep = ceil(100 / $dataPointsSum);
        $io = $this->getIo();
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
                        $io->progressAdvance($progressStep);
                    } catch (\Exception $e) {
                        echo $e->getMessage() . "\n";
                        $io->progressAdvance($progressStep);
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

    /**
     * @return SymfonyStyle
     */
    public function getIo(): SymfonyStyle
    {
        return $this->io;
    }

    /**
     * @param SymfonyStyle $io
     * @return LoadDataModel
     */
    public function setIo(SymfonyStyle $io): LoadDataModel
    {
        $this->io = $io;
        return $this;
    }

}
