<?php

namespace tests\ClearcodeHQ\CommandBusLauncher\Mocks;

use Ramsey\Uuid\Uuid;

class DummyCommandWithUuid
{
    /** @var string */
    private $argument1;

    /** @var Uuid */
    private $argumentUuid;

    public function __construct($argument1, $argumentUuid)
    {
        $this->argument1     = $argument1;
        $this->$argumentUuid = $argumentUuid;
    }
}
