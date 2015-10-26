<?php

namespace ClearcodeHQ\CommandBusLauncher;

class ArgumentsProcessor
{
    /**
     * @var ValueConveter[]
     */
    private $valueConveters;

    public function __construct(array $valueConveters = [])
    {
        $this->valueConveters = $valueConveters;
    }

    /**
     * @param $arguments
     *
     * @return mixed
     */
    public function process($arguments)
    {
        foreach ($arguments as $key => $argument) {
            $arguments[$key] = $this->convertValue($argument);
        }

        return $arguments;
    }

    private function convertValue($value)
    {
        foreach ($this->valueConveters as $valueConveter) {
            if (null !== $convertedValue = $valueConveter->convert($value)) {
                return $convertedValue;
            }
        }

        return $value;
    }
}
