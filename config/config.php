<?php

use Doctrine\ORM\EntityManager;
use function DI\env;
use function DI\get;
use function DI\string;
use function DI\factory;
use function DI\object;

chdir(__DIR__);

$config['applicationMode']            = $applicationMode;
$config['document.root']              = env('DOCUMENT_ROOT', getcwd() . '/..');
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
$config['path.mappings']              = [string('{document.root}/mapping')];
$config['path.proxy']                 = [string('{path.tmp}/proxies')];
$config['path.cache']                 = string('{path.tmp}/cache');
$config['path.metadata']              = string('{path.tmp}/metadata');
$config[Guard::class]                   = object(Guard::class);
$config[EntityManager::class]           = factory([EntityManagerFactory::class, 'create'])
        ->parameter('dbParams', get('dbParams'))
        ->parameter('applicationMode', get('applicationMode'))
        ->parameter('proxyDir', get('path.proxy'))
        ->parameter('paths', get('path.mappings'))
        ->parameter('redisParams', get('redisParams'))
        ->parameter('regionsParams', get('regionsParams'))
        ->parameter('proxyNamespace', get('proxyNamespace'))
        ->parameter('entityNamespaces', get('entityNamespaces'));

$config['doctrine.entity_manager'] = get(EntityManager::class);
$config[FixtureCommand::class]     = object(FixtureCommand::class)
        ->constructor(get('doctrine.entity_manager'), get('path.fixtures'));

return $config;
