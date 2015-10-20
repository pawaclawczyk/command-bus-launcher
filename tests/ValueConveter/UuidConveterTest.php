<?php

namespace tests\ClearcodeHQ\CommandBusLauncher\ValueConveter;

use ClearcodeHQ\CommandBusLauncher\ValueConveter\UuidConveter;
use Ramsey\Uuid\Uuid;

class UuidConveterTest extends \PHPUnit_Framework_TestCase
{
    /** @var UuidConveter */
    private $sut;

    public function setUp()
    {
        $this->sut = new UuidConveter();
    }

    /**
     * @test
     */
    public function it_converts_string_uuid()
    {
        $uuid = $this->sut->convert('9d3e2d0a-f4d0-496d-9a5f-a00fe99b2053');

        $this->assertInstanceOf(Uuid::class, $uuid);
        $this->assertEquals('9d3e2d0a-f4d0-496d-9a5f-a00fe99b2053', (string) $uuid);
    }

    /**
     * @test
     */
    public function it_does_not_converts_invalid_string_to_uuid()
    {
        $uuid = $this->sut->convert('9d3efe99b2053');

        $this->assertEquals(null, $uuid);
    }
}
