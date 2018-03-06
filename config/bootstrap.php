<?php

use Composer\Autoload\ClassLoader;

/* @var $loader ClassLoader */
$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->add('', '/tests');
$loader->addClassMap(['tests']);
$loader->addPsr4('', getcwd() . '/tests');
$classLoader = new \Composer\Autoload\ClassLoader();

$loader->register();

var_dump($loader->getClassMap());
var_dump($loader->getPrefixes());

require  __DIR__ . '/metaConfig.php';

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
