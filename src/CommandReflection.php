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
     * @param array              $inputArguemnts
     * @param ArgumentsProcessor $argumentsProcessor
     *
     * @return object
     *
     * @throws InvalidCommandArgument
     * @throws MissingCommandArgument
     */
    public function createCommand(array $inputArguemnts, ArgumentsProcessor $argumentsProcessor)
    {
        $classReflection = new \ReflectionClass($this->commandClass);

        foreach ($this->parameters() as $commandArgument) {
            if ($commandArgument->getClass() !== null) {
                if (!array_key_exists($commandArgument->getPosition(), $inputArguemnts)) {
                    throw new MissingCommandArgument(
                        sprintf("Missing arguemnt %s for '%s' command", $commandArgument->getPosition() + 1, $this->commandName)
                    );
                }

                $givenArgument         = $argumentsProcessor->convertValue($inputArguemnts[$commandArgument->getPosition()]);
                $requiredArgumentClass = $commandArgument->getClass()->name;
                if (!is_object($givenArgument) || $requiredArgumentClass !== get_class($givenArgument)) {
                    throw new InvalidCommandArgument(
                        sprintf(
                            "Invalid argument for '%s' command. Expected parameter %s to be instance of '%s'",
                            $this->commandName, $commandArgument->getPosition() + 1, $requiredArgumentClass
                        )
                    );
                }
            }
        }

        return $classReflection->newInstanceArgs($inputArguemnts);
    }
}
