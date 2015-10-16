<?php

namespace ClearcodeHQ\CommandBusLauncher;

class CommandReflection
{
    /** @var string */
    public $commandName;

    /** @var string */
    public $commandClass;

    /**
     * @param $commandName
     * @param $commandClass
     */
    public function __construct($commandName, $commandClass)
    {
        $this->commandName  = $commandName;
        $this->commandClass = $commandClass;
    }

    /**
     * @param $className
     *
     * @return CommandReflection
     */
    public static function fromClass($className)
    {
        $reflection = new \ReflectionClass($className);

        return new self($reflection->getShortName(), $className);
    }

    /**
     * @return \ReflectionParameter[]
     */
    public function parameters()
    {
        $commandReflection = new \ReflectionClass($this->commandClass);
        $commandParameters = $commandReflection->getConstructor()->getParameters();

        return $commandParameters;
    }

    /**
     * @param array $arguemnts
     *
     * @return object
     */
    public function createCommand(array $arguemnts)
    {
        $classReflection = new \ReflectionClass($this->commandClass);

        return $classReflection->newInstanceArgs($arguemnts);
    }
}
