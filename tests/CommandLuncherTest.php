<?php

namespace ClearcodeHQ\CommandBusLauncher\Tests;

use ClearcodeHQ\CommandBusLauncher\CommandCollector;
use ClearcodeHQ\CommandBusLauncher\CommandLuncher;
use ClearcodeHQ\CommandBusLauncher\CommandReflection;
use ClearcodeHQ\CommandBusLauncher\Tests\Mocks\DummyCommand;

class CommandLuncherTest extends \PHPUnit_Framework_TestCase
{
    /** @var CommandLuncher */
    private $sut;

    /** @var CommandCollector */
    private $commandCollector;

    /** @test */
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
        $this->commandCollector = $this->prophesize(CommandCollector::class);

        $this->sut = new CommandLuncher($this->commandCollector->reveal());
    }
}
