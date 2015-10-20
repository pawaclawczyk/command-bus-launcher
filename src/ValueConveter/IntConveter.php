<?php

namespace ClearcodeHQ\CommandBusLauncher\ValueConveter;

class IntConveter implements ValueConveter
{
    public function convert($rawValue)
    {
        if (is_numeric($rawValue)) {
            return (int) $rawValue;
        }

        return;
    }
}
