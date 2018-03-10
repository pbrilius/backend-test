#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/Samknows/Samknows.php';
require __DIR__ . '/config/metaConfig.php';

use Samknows\Command\LoadDataCommand;
use Samknows\Command\AggregateCommand;
use Samknows\Command\SearchCommand;
use Samknows\Tool\Application;

use DI\ContainerBuilder;
use Doctrine\Common\Cache\ArrayCache;

$builder = new ContainerBuilder();
$builder->useAutowiring(true);
$builder->useAnnotations(false);
$builder->ignorePhpDocErrors(true);
$cache = new ArrayCache();
$builder->writeProxiesToFile(true, $proxiesFile);
$builder->addDefinitions(__DIR__ . '/config/config.php');
$container = $builder->build();

$application = new Application(\Samknows\APPLICATION_NAME,
        \Samknows\APPLICATION_VERSION);
$application->add($container->get(LoadDataCommand::class));
$application->add($container->get(AggregateCommand::class));
$application->add($container->get(SearchCommand::class));

$application->setDefaultCommand($container
        ->get(LoaddataCommand::class)
        ->getName(), false);
$application->run();




