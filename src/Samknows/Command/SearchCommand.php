<?php

namespace Samknows\Command;

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
                    new InputDefinition(array(
                    new InputOption('foo', 'f'),
                    new InputOption('bar', 'b', InputOption::VALUE_REQUIRED),
                    new InputOption('cat', 'c', InputOption::VALUE_OPTIONAL),
                    ))
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