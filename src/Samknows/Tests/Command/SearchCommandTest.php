<?php

namespace Samknows\Tests\Command;

use Samknows\Command\SearchCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Samknows\Tests\Setup\CommadTestCase;

final class SearchCommandTest extends CommadTestCase
{

    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function testCanBeCreated(): void
    {
        $container = $this->getContainer();
        $this->assertEquals(SearchCommand::class, get_class($container->get(SearchCommand::class)));
    }

    public function testCanBeNamed()
    {
        $container = $this->getContainer();
        /* @var $searchCommand SearchCommand */
        $searchCommand = $container->get(SearchCommand::class);
        $this->assertEquals('app:search', $searchCommand->getName());
    }

    public function testCanBeCreatedWithArguments()
    {
        $container = $this->getContainer();
        /* @var $searchCommand SearchCommand */
        $searchCommand = $container->get(SearchCommand::class);
        $this->assertGreaterThanOrEqual(3, count($searchCommand->getDefinition()->getOptions()));
    }

    public function testCanBeCreatedWithDescription()
    {
        $container = $this->getContainer();
        /* @var $searchCommand SearchCommand */
        $searchCommand = $container->get(SearchCommand::class);
        $this->assertRegExp('/[\w\s\.]{8,}/', $searchCommand->getDescription());
    }

    public function testExecute()
    {
        $container = $this->getContainer();
        /* @var $searchCommand SearchCommand */
        $searchCommand = $container->get(SearchCommand::class);
        $application = $this->getApplication();
        $command = $application->find($searchCommand->getName());
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command'  => $command->getName(),
            '--unit' => '5',
            '--hour' => '16',
            '--metric' => 'download',
        ]);

        $output = $commandTester->getDisplay();
        $this->assertContains('Found data', $output);
    }

}