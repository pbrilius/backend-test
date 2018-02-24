<?php

namespace Samknows\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of AggregateCommand
 *
 * @author paul
 */
class AggregateCommand extends Command
{
    
    protected static $defaultName = 'app:aggregate';
    private $aggregateModel;
    
    public function __construct($aggregateModel)
    {
        $this->aggregateModel = $aggregateModel;
    }

    public function getAggregateModel()
    {
        return $this->aggregateModel;
    }

    public function setAggregateModel($aggregateModel)
    {
        $this->aggregateModel = $aggregateModel;
        return $this;
    }

    protected function configure()
    {
        $this
            ->setName('app:aggregate')
            ->setDescription('Aggregates the data into the'
                . ' searchable fields'
            )
            ->setHelp('This command allows you to aggregate'
                    . ' data into searchable fields using search conditions')
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->aggregateModel->agregate();
    }

}
