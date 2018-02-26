<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once 'bootstrap.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = $container->get('doctrine.entity_manager');

return ConsoleRunner::createHelperSet($entityManager);