<?php

namespace Samknows\Factory\Model;

use Samknows\Model\AggregateModel;
use Doctrine\ORM\EntityManager;

/**
 * Description of AggregateModelFactory
 *
 * @author paul
 */
class AggregateModelFactory
{
    public function createAgggregateModel(EntityManager $em)
    {
        return new AggregateModel($em);
    }
}
