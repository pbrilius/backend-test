<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__ . '/metaConfig.php';

use DI\ContainerBuilder;
use Doctrine\Common\Cache\ArrayCache;

$builder = new ContainerBuilder();
$builder->useAutowiring(true);
$builder->useAnnotations(false);
$builder->ignorePhpDocErrors(true);
$cache = new ArrayCache();
//$builder->setDefinitionCache($cache);
$builder->writeProxiesToFile(true, $proxiesFile);
$builder->addDefinitions(__DIR__ . '/config.php');
$container = $builder->build();

//chdir(__DIR__);
//require __DIR__ . '/../../config/config.php';
