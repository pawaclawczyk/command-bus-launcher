<?php

namespace tests\ClearcodeHQ\CommandBusLauncher\Mocks;

use Assert\Assertion;

class DummyCommand
{
    /** @var string */
    private $argument1;

    /** @var int */
    private $argument2;

    public function __construct($argument1, $argument2)
    {
        Assertion::integer($argument2);

        $this->argument1 = $argument1;
        $this->argument2 = $argument2;
    }
}
