<?php

namespace Samknows\Factory\Doctrine;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * Description of EntityManager
 *
 * @author paul
 */
class EntityManagerFactory
{
    public function createEntityManager(array $dbParams, $paths, $mode)
    {
        $isDevMode = $mode == 'development' ? true : false;
        $config = Setup::createXMLMetadataConfiguration($paths, $isDevMode);
        $entityManager = EntityManager::create($dbParams, $config);
        
        return $entityManager;
    }
}
