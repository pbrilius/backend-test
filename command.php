#!/usr/bin/env php
<?php
require __DIR__.'/vendor/autoload.php';

use Samknows\Command\LoaddataCommand;
use Samknows\Command\AggregateCommand;
use Samknows\Command\SearchCommand;
use Symfony\Component\Console\Application;

$application = new Application('echo', '1.0.0');

$loaddataCommand = new LoaddataCommand();
$application->add($loaddataCommand);
$application->add((new AggregateCommand()));
$application->add((new SearchCommand()));

$application->setDefaultCommand($loaddataCommand->getName(), true);
$application->run();