<?php

namespace Samknows\Repository\QueryBuilder;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManager;
use Samknows\Entity\DataPoint as DataPointEntity;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * Description of DataPoint
 *
 * @author paul
 */
abstract class DataPoint extends EntityRepository
{
    /**
     *
     * @var QueryBuilder
     */
    protected $qb;
    
    public function __construct(EntityManager $em)
    {
        $metadata = new ClassMetadata(DataPointEntity::class);
        parent::__construct($em, $metadata);

        $this->qb = $this->createQueryBuilder('dp')
            ->select('dp.*')
            ->from(DataPoint::class, 'dp');
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
