<?php

namespace Samknows\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Samknows\Entity\AggregatedDataPoints as AggregatedDataPointsEntity;

/**
 * Description of AggregatedDataPoints
 *
 * @author paul
 */
class AggregatedDataPoints extends EntityRepository
{
    /**
     *
     * @var QueryBuilder 
     */
    private $qb;
    
    public function __construct(EntityManager $em)
    {
        $metadata = new ClassMetadata(AggregatedDataPointsEntity::class);
        parent::__construct($em, $metadata);
        $this->qb = $this->createQueryBuilder('adp')
                ->from(AggregatedDataPointsEntity::class, 'adp');
    }
    
    public function getQb()
    {
        return $this->qb;
    }

    public function setQb($qb)
    {
        $this->qb = $qb;
        return $this;
    }

}
