<?php
namespace Samknows\Command;

use Samknows\Model\LoadDataModel;

/**
 * Description of LoaddataCommand
 *
 * @author paul
 */
class LoadDataCommand extends Command
{
    
    protected static $defaultName = 'app:loaddata';
    
    /**
     *
     * @var type LoadDataModel
     */
    private $loadDataModel;
    
    public function __construct(LoadDataModel $loaddataModel)
    {
        $this->loaddataModel = $loaddataModel;
    }

    public function getLoaddataModel()
    {
        return $this->loaddataModel;
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
            ->setDefinition(
                new InputDefinition([
                        new InputOption('data-file', 'f', InputOption::VALUE_REQUIRED),
                    ])
                )
            ->setDescription('Loading data into database from CSV file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->loaddataModel->loadData();
    }
}
