<?php

namespace Samknows\Command;

use Samknows\Model\SearchModel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Helper\Table;


/**
 * Description of SearchCommand
 *
 * @author paul
 */
class SearchCommand extends Command
{
    protected static $defaultName = 'app:search';
    
    /**
     *
     * @var type SearchModel
     */
    private $searchModel;
    
    public function __construct(SearchModel $searchModel)
    {
        parent::__construct();
        $this->searchModel = $searchModel;
    }
    
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
                        new InputOption('hour', 't', InputOption::VALUE_REQUIRED),
                    ])
                )
                ->setHelp('This command allows search data for entries'
                        . ' mathing search conditions')
        ;
    }
    
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Data Search');
        $io->section('Searching data');
        $criteria = [
            'unit' => $input->getOptions()['unit'],
            'metric' => $input->getOptions()['metric'],
            'hour' => (int) $input->getOptions()['hour'] - 1,
        ];
        try {
            $io->progressStart();
            $entries = $this->searchModel->search($criteria);

            $table = new Table($output);
            $headers = [
                'Unit',
                'Hour',
            ];
            foreach (\Samknows\INDICATORS as $indicator) {
                $headers[] = mb_convert_case(
                    str_replace('_', ' ', $criteria['metric']), MB_CASE_TITLE)
                    . ' '
                    . mb_convert_case($indicator, MB_CASE_TITLE);
            }
            $headers[] = 'Sample Size';
            $table
                ->setHeaders($headers)
                ->setRows($entries)
            ;
            $io->progressFinish();
            $io->success('Found data');
            $table->render();
        } catch (\Exception $e) {
            $io->error($e->getMessage());
        }
    }
    
    public function setSearchModel(SearchModel $searchModel)
    {
        $this->searchModel = $searchModel;
    }
    
    public function getSearchModel(): SearchModel
    {
        return $this->searchModel;
    }
    
}
