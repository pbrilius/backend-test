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
//        var_dump(get_class($em->getRepository(DataPoint::class)));
//        var_dump($em->getRepository(DataPoint::class));
//        die;
        return new LoadDataModel($em, $documentRoot);
    }
}
