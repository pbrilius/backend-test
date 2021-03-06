<?php

namespace Samknows\Factory\Model;

use Samknows\Model\SearchModel;
use Doctrine\ORM\EntityManager;
use Samknows\Entity\AggregatedDataPoints;

/**
 * Description of SearchModelFactory
 *
 * @author paul
 */
class SearchModelFactory
{
    public function create(EntityManager $em)
    {
        return new SearchModel(
            $em->getRepository(AggregatedDataPoints::class)
        );
    }
}
