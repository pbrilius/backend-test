<?php

namespace Samknows\Factory\Model;

use Samknows\Model\LoadDataModel;
use Doctrine\ORM\EntityManager;

/**
 * Description of LoadDataModelFactory
 *
 * @author paul
 */
class LoadDataModelFactory
{
    public function createLoadDataModel(EntityManager $em)
    {
        return new LoadDataModel($em);
    }
}
