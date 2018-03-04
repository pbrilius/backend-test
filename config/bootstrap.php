<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__ . '/metaConfig.php';

use DI\ContainerBuilder;
use Doctrine\Common\Cache\ArrayCache;

$builder = new ContainerBuilder();
$builder->useAutowiring(true);
$builder->useAnnotations(false);
$builder->ignorePhpDocErrors(true);
$cache = new ArrayCache();
if (extension_loaded('apcu') && $applicationMode == 'production') {
    $builder->enableDefinitionCache();
}
$builder->writeProxiesToFile(true, $proxiesFile);
$builder->addDefinitions(__DIR__ . '/config.php');
$container = $builder->build();
