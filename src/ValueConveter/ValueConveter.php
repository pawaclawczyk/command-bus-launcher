<?php

namespace ClearcodeHQ\CommandBusLauncher\ValueConveter;

interface ValueConveter
{
    public function convert($rawValue);
}
