<?php
namespace Samknows\Command;

/**
 * Description of LoaddataCommand
 *
 * @author paul
 */
class LoaddataCommand extends Command
{
    
    protected static $defaultName = 'app:loaddata';
    
    private $logger;
    private $loaddataModel;
    
    public function __construct($logger, $loaddataModel)
    {
        $this->logger        = $logger;
        $this->loaddataModel = $loaddataModel;
    }

    
    public function getLogger()
    {
        return $this->logger;
    }

    public function getLoaddataModel()
    {
        return $this->loaddataModel;
    }

    public function setLogger($logger)
    {
        $this->logger = $logger;
        return $this;
    }

    public function setLoaddataModel($loaddataModel)
    {
        $this->loaddataModel = $loaddataModel;
        return $this;
    }

        protected function configure()
    {
        $this
            ->setName('app:loaddata')
            ->setDescription('Loading data into database'
                    . ' from CSV file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->loaddataModel->loadData();
    }
}
