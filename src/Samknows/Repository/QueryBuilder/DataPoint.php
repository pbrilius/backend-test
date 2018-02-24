<?php

namespace Samknows\Repository\QueryBuilder;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
/**
 * Description of DataPoint
 *
 * @author paul
 */
class DataPoint extends EntityRepository
{
    /**
     *
     * @var QueryBuilder
     */
    protected $qb;
    
    public function __construct()
    {
        $this->qb = $this->createQueryBuilder('dp')
                ->select('dp.*')
                ->from(self::class, 'dp');
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
