#!/usr/bin/env php
<?php
require __DIR__.'/vendor/autoload.php';

use Samknows\Command\LoaddataCommand;
use Samknows\Command\AggregateCommand;
use Samknows\Command\SearchCommand;
use Samknows\Tool\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__ ));
$loader->load('config/services.yaml');

$application = new Application(Samknows\APPLICATION_NAME,
        Samknows\APPLICATION_VERSION);

$loaddataCommand = new LoaddataCommand();
$application->add($container->get(LoaddataCommand::class));
$application->add($container->get(AggregateCommand::class));
$application->add($container->get(SearchCommand::class));

$application->setDefaultCommand($container
        ->get(LoaddataCommand::class)
        ->getName(), true);

$application->run();

