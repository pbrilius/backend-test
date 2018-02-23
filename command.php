#!/usr/bin/env php
<?php
require __DIR__.'/vendor/autoload.php';

use Samknows\Command\LoaddataCommand;
use Samknows\Command\AggregateCommand;
use Samknows\Command\SearchCommand;
use Samknows\Tool\Application;

$application = new Application(Samknows\APPLICATION_NAME,
        Samknows\APPLICATION_VERSION);

$loaddataCommand = new LoaddataCommand();
$application->add($loaddataCommand);
$application->add((new AggregateCommand()));
$application->add((new SearchCommand()));

$application->setDefaultCommand($loaddataCommand->getName(), true);
$application->run();