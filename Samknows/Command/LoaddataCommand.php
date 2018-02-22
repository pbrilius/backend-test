<?php
namespace Samknows\Command;

/**
 * Description of LoaddataCommand
 *
 * @author paul
 */
class LoaddataCommand
{
    
    private $logger;
    //put your code here
    
    protected function configure()
    {
        $this
            ->setName('app:sunshine')
            ->setDescription('Good morning!');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->logger->info('Waking up the sun');
        // ...
    }
}
