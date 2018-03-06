<?php

namespace Samknows\Command;

use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManager;
use Nelmio\Alice\Fixtures;

class FixtureCommand
{
    private $entityManager;
    private $config;

    public function __construct(EntityManager $entityManager, $config)
    {
        $this->entityManager = $entityManager;
        $this->config = $config;
    }

    public function __invoke($action, OutputInterface $output)
    {
        $output->writeln('Beginning to ' . $action);
        switch ($action) {
            case 'generate':
                $entityManager = $this->getEntityManager();
                $objects = Fixtures::load($this->getConfig(), $entityManager);
                foreach ($objects as $entity) {
                    $output->writeln('Generating entity');
                    $entityManager->persist($entity);
                }
                break;
            case '':
            default:
                $output->writeln('Fixture command for processing fixtures');
        }
        $output->writeln('Performed ' . $action . ' command');
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }




}
