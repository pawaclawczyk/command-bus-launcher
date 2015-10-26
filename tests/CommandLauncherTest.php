<?php

namespace tests\ClearcodeHQ\CommandBusLauncher;

use ClearcodeHQ\CommandBusLauncher\ArgumentsProcessor;
use ClearcodeHQ\CommandBusLauncher\CommandCollector;
use ClearcodeHQ\CommandBusLauncher\CommandBusLauncher;
use ClearcodeHQ\CommandBusLauncher\CommandLauncher;
use ClearcodeHQ\CommandBusLauncher\CommandReflection;
use tests\ClearcodeHQ\CommandBusLauncher\Mocks\DummyCommand;

class CommandLauncherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CommandLauncher
     */
    private $sut;

    /**
     * @var CommandCollector
     */
    private $commandCollector;

    /**
     * @var ArgumentsProcessor
     */
    private $argumentsProcessor;

    /**
     * @test
     */
    public function it_returns_command_to_launch()
    {
        $this->commandCollector->getCommandByName('DummyCommand')->willReturn(
            CommandReflection::fromClass(DummyCommand::class)
        );

        $command = $this->sut->getCommandToLaunch('DummyCommand', ['lorem ipsum', 123]);

        $this->assertInstanceOf(DummyCommand::class, $command);
    }

    public function setUp()
    {
        $this->commandCollector   = $this->prophesize(CommandCollector::class);
        $this->argumentsProcessor = $this->prophesize(ArgumentsProcessor::class);

        $this->sut = new CommandLauncher($this->commandCollector->reveal(), $this->argumentsProcessor->reveal());
    }
}
