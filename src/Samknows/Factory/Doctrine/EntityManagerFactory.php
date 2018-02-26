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
        var_dump(func_get_args());
//        die;
        $isDevMode = $mode == 'development' ? true : false;
        $cache     = new ArrayCache();
        $config = Setup::createXMLMetadataConfiguration($paths, $isDevMode);
        $config->setQueryCacheImpl($cache);
        $config->setHydrationCacheImpl($cache);
        $config->setMetadataCacheImpl($cache);
        $config->setProxyDir($proxyDir);
        var_dump('test a15');
        $config->setProxyNamespace($proxyNamespace);
        $config->setEntityNamespaces($entityNamespaces);
        var_dump('test a16');
        if ($isDevMode) {
            $config->setAutoGenerateProxyClasses(AbstractProxyFactory::AUTOGENERATE_EVAL);
        } else {
            $config->setAutoGenerateProxyClasses(AbstractProxyFactory::AUTOGENERATE_NEVER);
        }
        $entityManager = EntityManager::create($dbParams, $config);
        
        return $entityManager;
    }
}
