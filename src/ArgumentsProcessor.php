<?php

namespace ClearcodeHQ\CommandBusLauncher;

class ArgumentsProcessor
{
    public function process($argumentsString)
    {
        $arguments = explode(' ', $argumentsString);

        foreach ($arguments as $key => $argument) {
            if (is_numeric($argument)) {
                $arguments[$key] = intval($argument);
            }
        }

        return $arguments;
    }
}
