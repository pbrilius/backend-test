#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/Samknows/Samknows.php';
require __DIR__ . '/config/meta-config.php';

use Samknows\Command\LoadDataCommand;
use Samknows\Command\AggregateCommand;
use Samknows\Command\SearchCommand;
use Samknows\Tool\Application;

$application = new Application(\Samknows\APPLICATION_NAME,
        \Samknows\APPLICATION_VERSION);
$application->add($container->get(LoadDataCommand::class));
$application->add($container->get(AggregateCommand::class));
$application->add($container->get(SearchCommand::class));

$application->setDefaultCommand($container
        ->get(LoaddataCommand::class)
        ->getName(), false);
$application->run();




