<?php
namespace Samknows\Command;

use Samknows\Model\LoadDataModel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Description of LoaddataCommand
 *
 * @author paul
 */
class LoadDataCommand extends Command
{
    
    protected static $defaultName = 'app:load-data';
    
    /**
     *
     * @var type LoadDataModel
     */
    private $loadDataModel;
    
    public function __construct(LoadDataModel $loadDataModel)
    {
        parent::__construct();
        $this->loadDataModel = $loadDataModel;
    }

    public function getLoaddataModel(): LoadDataModel
    {
        return $this->loadDataModel;
    }

    public function setLoaddataModel(LoadDataModel $loadDataModel)
    {
        $this->loadDataModel = $loadDataModel;
        return $this;
    }

    protected function configure()
    {
        $this
            ->setName('app:load-data')
            ->addArgument('data-file', InputArgument::REQUIRED,
                    'File to laod data from')
            ->setDescription('Loading data into database from CSV file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = $input->getArgument('data-file');
        $io = new SymfonyStyle($input, $output);
        $io->title('Data Load');
        $io->section('Loading data');
        $io->createProgressBar(\Samknows\PROGRESS_BAR_PERCENTAGE);
        $io->progressStart();
        $this->loadDataModel->setIo($io);
        try {
            $this->loadDataModel->loadData($fileName);
            $io->progressFinish();
            $io->success('Data loaded');
        } catch (\Exception $e) {
            $io->progressFinish();
            $io->error($e->getMessage());
        }
    }
}
