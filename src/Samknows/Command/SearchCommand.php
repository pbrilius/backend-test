<?php

namespace Samknows\Command;

use Samknows\Model\LoadDataModel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of SearchCommand
 *
 * @author paul
 */
class SearchCommand extends Command
{
    protected static $defaultName = 'app:search';
    
    protected function configure()
    {
        $this
                ->setName('app:search')
                ->setDescription('Searches data for the entries following'
                    . ' the search conditions'
                )
                ->setDefinition(
                    new InputDefinition([
                        new InputOption('unit', 'u', InputOption::VALUE_REQUIRED),
                        new InputOption('metric', 'm', InputOption::VALUE_REQUIRED),
                        new InputOption('hour', 'h', InputOption::VALUE_REQUIRED),
                    ])
                )
                ->setHelp('This command allows search data for entries'
                        . ' mathing search conditions')
        ;
    }
    
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $input->get($arguments);
        $conditions = $arguments;
        $response = $this->searchModel->search($conditions);
        $output->writeln($response);
    }
}
