<?php

namespace Samknows\Factory\Model;

use Samknows\Model\SearchModel;
use Doctrine\ORM\EntityManager;

/**
 * Description of SearchModelFactory
 *
 * @author paul
 */
class SearchModelFactory
{
    public function createSearchModel(EntityManager $em)
    {
        return new SearchModel($em);
    }
}
