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

        $this->assertEquals(123, $int);
    }

    /**
     * @test
     */
    public function it_does_not_converts_non_numberic_string_to_int()
    {
        $invalidInt = $this->sut->convert('string');

        $this->assertEquals(null, $invalidInt);
    }
}
