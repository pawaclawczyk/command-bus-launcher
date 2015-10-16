<?php

namespace ClearcodeHQ\CommandBusLauncher\Tests;

use ClearcodeHQ\CommandBusLauncher\CommandReflection;
use ClearcodeHQ\CommandBusLauncher\Tests\Mocks\DummyCommand;

class CommandReflectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_can_be_created_from_class_name()
    {
        $commandReflection = CommandReflection::fromClass(DummyCommand::class);

        \PHPUnit_Framework_Assert::assertInstanceOf(CommandReflection::class, $commandReflection);
    }

    /**
     * @test
     */
    public function it_returns_command_constructor_parameters()
    {
        $commandReflection = CommandReflection::fromClass(DummyCommand::class);

        $commandParameters = $commandReflection->parameters();

        \PHPUnit_Framework_Assert::assertEquals('argument1', $commandParameters[0]->name);
        \PHPUnit_Framework_Assert::assertEquals('argument2', $commandParameters[1]->name);
    }

    /**
     * @test
     */
    public function it_create_new_command_instance()
    {
        $commandReflection = CommandReflection::fromClass(DummyCommand::class);

        $commandParameters = ['lorem ipsum', 2];
        $command           = $commandReflection->createCommand($commandParameters);

        \PHPUnit_Framework_Assert::assertInstanceOf(DummyCommand::class, $command);
    }
}
