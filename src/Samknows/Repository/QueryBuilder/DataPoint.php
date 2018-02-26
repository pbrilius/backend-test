<?php

namespace Samknows\Repository\QueryBuilder;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Samknows\Entity\DataPoint;
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
        $metadata = new ClassMetadata($this->entity());
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
