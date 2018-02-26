<?php

namespace Samknows\Factory\Model;

use Samknows\Model\LoadDataModel;
use Doctrine\ORM\EntityManager;
use Samknows\Entity\DataPoint;

/**
 * Description of LoadDataModelFactory
 *
 * @author paul
 */
class LoadDataModelFactory
{
    public function create(EntityManager $em, $documentRoot)
    {
        return new LoadDataModel($em, $documentRoot);
    }
}
