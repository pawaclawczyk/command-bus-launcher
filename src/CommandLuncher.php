<?php

namespace ClearcodeHQ\CommandBusLauncher;

class CommandLuncher
{
    /** @var CommandCollector */
    private $commandCollector;

    public function __construct(CommandCollector $commandCollector)
    {
        $this->commandCollector = $commandCollector;
    }

    public function getCommandToLunch($commandName, $arguments)
    {
        $commandReflection = $this->commandCollector->getCommandByName($commandName);

        return $commandReflection->createCommand($arguments);
    }
}
