<?php

namespace Samknows\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Samknows\Model\AggregateModel;

/**
 * Description of AggregateCommand
 *
 * @author paul
 */
class AggregateCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:aggregate';
    /**
     * @var AggregateModel
     */
    private $aggregateModel;
    
    public function __construct(AggregateModel $aggregateModel)
    {
        parent::__construct();
        $this->aggregateModel = $aggregateModel;
    }

    public function getAggregateModel() : AggregateModel
    {
        return $this->aggregateModel;
    }

    public function setAggregateModel(AggregateModel $aggregateModel)
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
        $io = new SymfonyStyle($input, $output);
        $io->title('Aggregation');
        $io->section('Aggregating');
        try {
            $io->createProgressbar(\Samknows\PROGRESS_BAR_PERCENTAGE);
            $io->progressStart();
            $this->aggregateModel->aggregateDataPoints();
            $io->progressFinish();
            $io->success('Data aggregated');
        } catch (\Exception $e) {
            $io->progressFinish();
            $io->error($e->getMessage());
        }
    }

}
