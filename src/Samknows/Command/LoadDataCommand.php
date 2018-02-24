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
    
    public function __construct(LoadDataModel $loadDataModel)
    {
        $this->loadDataModel = $loadDataModel;
    }

    public function getLoaddataModel()
    {
        return $this->loadDataModel;
    }

    public function setLoaddataModel($loadDataModel)
    {
        $this->loadDataModel = $loadDataModel;
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
        $this->loadDataModel->loadData();
    }
}
