<?php

namespace ClearcodeHQ\CommandBusLauncher;

class CommandLuncher
{
    /**
     * @var CommandCollector
     */
    private $commandCollector;

    /**
     * @var ArgumentsProcessor
     */
    private $argumentsProcessor;

    public function __construct(CommandCollector $commandCollector, ArgumentsProcessor $argumentsProcessor)
    {
        $this->commandCollector   = $commandCollector;
        $this->argumentsProcessor = $argumentsProcessor;
    }

    /**
     * @param $commandName
     * @param $arguments
     *
     * @return object
     *
     * @throws CommandDoesNotExist
     */
    public function getCommandToLunch($commandName, $arguments)
    {
        $commandReflection = $this->commandCollector->getCommandByName($commandName);

        return $commandReflection->createCommand($arguments, $this->argumentsProcessor);
    }
}
