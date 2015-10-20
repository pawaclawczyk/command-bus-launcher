<?php

namespace tests\ClearcodeHQ\CommandBusLauncher;

use ClearcodeHQ\CommandBusLauncher\ArgumentsProcessor;
use ClearcodeHQ\CommandBusLauncher\CommandCollector;
use ClearcodeHQ\CommandBusLauncher\CommandBusLauncher;
use ClearcodeHQ\CommandBusLauncher\CommandLuncher;
use ClearcodeHQ\CommandBusLauncher\CommandReflection;
use tests\ClearcodeHQ\CommandBusLauncher\Mocks\DummyCommand;

class CommandLuncherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CommandLuncher
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
    public function it_returns_command_to_lunch()
    {
        $this->commandCollector->getCommandByName('DummyCommand')->willReturn(
            CommandReflection::fromClass(DummyCommand::class)
        );

        $command = $this->sut->getCommandToLunch('DummyCommand', ['lorem ipsum', 123]);

        $this->assertInstanceOf(DummyCommand::class, $command);
    }

    public function setUp()
    {
        $this->commandCollector   = $this->prophesize(CommandCollector::class);
        $this->argumentsProcessor = $this->prophesize(ArgumentsProcessor::class);

        $this->sut = new CommandLuncher($this->commandCollector->reveal(), $this->argumentsProcessor->reveal());
    }
}
