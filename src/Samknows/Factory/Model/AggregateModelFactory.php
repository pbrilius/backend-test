<?php

namespace Samknows\Factory\Model;

use Samknows\Model\AggregateModel;
use Doctrine\ORM\EntityManager;
use Samknows\Entity\AggregatedDataPoints;

/**
 * Description of AggregateModelFactory
 *
 * @author paul
 */
class AggregateModelFactory
{
    public function create(EntityManager $em)
    {
        return new AggregateModel($em->getRepository(AggregatedDataPoints::class));
    }
}
