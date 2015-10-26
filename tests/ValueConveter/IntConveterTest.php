<?php

namespace tests\ClearcodeHQ\CommandBusLauncher\ValueConveter;

use ClearcodeHQ\CommandBusLauncher\ValueConveter\IntConveter;

class IntConveterTest extends \PHPUnit_Framework_TestCase
{
    /** @var IntConveter */
    private $sut;

    public function setUp()
    {
        $this->sut = new IntConveter();
    }

    /**
     * @test
     */
    public function it_converts_string_to_int()
    {
        $int = $this->sut->convert('123');

        $this->assertTrue(123 === $int);
    }

    /**
     * @test
     */
    public function it_does_not_converts_non_numeric_string_to_int()
    {
        $invalidInt = $this->sut->convert('string');

        $this->assertTrue($invalidInt === null);
    }
}
