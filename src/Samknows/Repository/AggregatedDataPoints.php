<?php

namespace Samknows\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

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
    
    public function __construct($qb)
    {
        $this->qb = $this->createQueryBuilder('adp')
                ->from(self::class, 'adp');
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

    public function search()
    {
        
    }
}
