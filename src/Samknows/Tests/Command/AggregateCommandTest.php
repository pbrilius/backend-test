<?php

namespace Samknows\Tests\Command;

use Samknows\Command\AggregateCommand;
use Samknows\Tests\Setup\CommadTestCase;
use Symfony\Component\Console\Tester\CommandTester;

final class AggregateCommandTest extends CommadTestCase
{

    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function testCanBeCreated(): void
    {
        $container = $this->getContainer();
        $this->assertEquals(AggregateCommand::class, $container->get(AggregateCommand::class));
    }

    public function testCanBeNamed()
    {
        $container = $this->getContainer();
        /* @var $aggregateCommand AggregateCommand */
        $aggregateCommand = $container->get(AggregateCommand::class);
        $this->assertEquals('app:load-data', $aggregateCommand->getName());
    }

    public function testCanBeCreatedWithArguments()
    {
        $container = $this->getContainer();
        /* @var $aggregateCommand aggregateCommand */
        $aggregateCommand = $container->get(aggregateCommand::class);
        $this->assertEqual(0, $aggregateCommand->getDefinition()->getArgumentCount());
    }

    public function testCanBeCreatedWithDescription()
    {
        $container = $this->getContainer();
        /* @var $aggregateCommand aggregateCommand */
        $aggregateCommand = $container-get(aggregateCommand::class);
        $this->assertStringMatchesFormat('[\w\s\.]{8,}', $aggregateCommand->getDescription());
    }

    public function testExecute()
    {
        $container = $this->getContainer();
        /* @var $aggregateCommand aggregateCommand */
        $aggregateCommand = $container->get(aggregateCommand::class);
        $application = $this->getApplication();
        $command = $application->find($aggregateCommand->getName());

        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
        ));

        $output = $commandTester->getDisplay();
        $this->assertContains('Data aggregated', $output);
    }

}