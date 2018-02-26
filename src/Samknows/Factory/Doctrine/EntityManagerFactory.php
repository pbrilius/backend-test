<?php

namespace Samknows\Factory\Doctrine;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Proxy\AbstractProxyFactory;

/**
 * Description of EntityManager
 *
 * @author paul
 */
class EntityManagerFactory
{
    public function create(array $dbParams, $paths, $mode, $proxyDir,
            $proxyNamespace,
            $entityNamespaces)
    {
        $isDevMode = $mode == 'development' ? true : false;
        $cache     = new ArrayCache();
        $config = Setup::createXMLMetadataConfiguration($paths, $isDevMode);
        $config->setQueryCacheImpl($cache);
        $config->setHydrationCacheImpl($cache);
        $config->setMetadataCacheImpl($cache);
        $config->setProxyDir($proxyDir);
        $config->setProxyNamespace($proxyNamespace);
        $config->setEntityNamespaces($entityNamespaces);
        $config->addCustomStringFunction('date_format', 'Mapado\MysqlDoctrineFunctions\DQL\MysqlDateFormat');
        if ($isDevMode) {
            $config->setAutoGenerateProxyClasses(AbstractProxyFactory::AUTOGENERATE_EVAL);
        } else {
            $config->setAutoGenerateProxyClasses(AbstractProxyFactory::AUTOGENERATE_NEVER);
        }
        $entityManager = EntityManager::create($dbParams, $config);
        
        return $entityManager;
    }
}
