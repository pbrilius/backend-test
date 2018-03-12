<?php

use Doctrine\ORM\EntityManager;
use Samknows\Model\AggregateModel;
use Samknows\Model\LoadDataModel;
use Samknows\Model\SearchModel;
use Samknows\Factory\Doctrine\EntityManagerFactory;
use Samknows\Factory\Model\AggregateModelFactory;
use Samknows\Factory\Model\LoadDataModelFactory;
use Samknows\Factory\Model\SearchModelFactory;
use Samknows\Command\AggregateCommand;
use Samknows\Command\FixtureCommand;
use Samknows\Command\LoadDataCommand;
use Samknows\Command\SearchCommand;
use function DI\env;
use function DI\get;
use function DI\string;
use function DI\factory;
use function DI\autowire;

chdir(__DIR__);

$config['applicationMode']            = env('APPLICATION_MODE', 'development');
$config['document.root']              = getcwd() . '/..';
$config['dbParams']                   = [
    'driver'        => 'pdo_mysql',
    'user'          => 'backend_test',
    'password'      => 'backend_test',
    'dbname'        => 'backend_test',
    'charset'       => 'utf8mb4',
    'collation'     => 'utf8mb4_unicode_ci',
    'driverOptions' => [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
    ],
];
$config['path.tmp']                   = string('{document.root}/tmp');
$config['path.initialize']            = string('{document.root}/initialize');
$config['path.fixtures']              = string('{path.initialize}/fixtures.yml');
$config['path.mappings']              = [string('{document.root}/mappings')];
$config['path.proxy']                 = [string('{path.tmp}/proxies')];
$config['path.cache']                 = string('{path.tmp}/cache');
$config['path.metadata']              = string('{path.tmp}/metadata');
$config['proxyNamespace']             = 'Pixelpitch\Easynote\Proxies';
$config['entityNamespaces']           = ['Samknows\Entity'];
$config['regionsParams']              = [
    'defaultLifetime' => 4096
];
$config[EntityManager::class]         = factory([new EntityManagerFactory, 'create'])
        ->parameter('dbParams', get('dbParams'))
        ->parameter('paths', get('path.mappings'))
        ->parameter('mode', get('applicationMode'))
        ->parameter('proxyDir', get('path.proxy'))
        ->parameter('proxyNamespace', get('proxyNamespace'))
        ->parameter('entityNamespaces', get('entityNamespaces'));
$config['doctrine.entity_manager'] = get(EntityManager::class);
$config[AggregateModel::class] = factory([new AggregateModelFactory(), 'create']);
$config[LoadDataModel::class] = factory([new LoadDataModelFactory(), 'create'])
        ->parameter('documentRoot', get('document.root'));
$config[SearchModel::class] = factory([new SearchModelFactory(), 'create']);
$config[FixtureCommand::class] = autowire()
        ->constructorParameter('config', get('path.fixtures'));
$config[AggregateCommand::class] = autowire();
$config[LoadDataCommand::class] = autowire();
$config[SearchCommand::class] = autowire();

chdir($config['document.root']);

return $config;
