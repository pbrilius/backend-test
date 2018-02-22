<?php

namespace Samknows\Command;

/**
 * Description of SearchCommand
 *
 * @author paul
 */
class SearchCommand
{
    protected function configure()
    {
        $this
                // the name of the command (the part after "bin/console")
                ->setName('app:aggregater')
                ->setDescription('Aggregates the data into the'
                    . ' searchable fields'
                )
                ->setDefinition(
                    new InputDefinition(array(
                    new InputOption('foo', 'f'),
                    new InputOption('bar', 'b', InputOption::VALUE_REQUIRED),
                    new InputOption('cat', 'c', InputOption::VALUE_OPTIONAL),
                    ))
                )
                ->setHelp('This command allows you to create a user...')
        ;
    }
    
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello World');
    }
}
