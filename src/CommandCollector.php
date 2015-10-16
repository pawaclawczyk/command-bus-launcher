<?php

namespace ClearcodeHQ\CommandBusLauncher;

class CommandCollector
{
    /** @var CommandReflection[] */
    public $commands = [];

    /**
     * @param array $services
     */
    public function processCommandServices(array $services)
    {
        foreach ($services as $serviceId => $service) {
            foreach ($service as $tags) {
                if (array_key_exists('handles', $tags)) {
                    $commandClass     = $tags['handles'];
                    $this->commands[] = CommandReflection::fromClass($commandClass);
                }
            }
        }
    }

    public function getCommandByName($commandName)
    {
        foreach ($this->commands as $command) {
            if ($command->commandName == $commandName) {
                return $command;
            }
        }

        throw new CommandDoesNotExist();
    }
}
