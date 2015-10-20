<?php

namespace ClearcodeHQ\CommandBusLauncher\ValueConveter;

use Ramsey\Uuid\Uuid;

class UuidConveter implements ValueConveter
{
    public function convert($rawValue)
    {
        try {
            return Uuid::fromString($rawValue);
        } catch (\Exception $e) {
            return;
        }
    }
}
