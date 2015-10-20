<?php

namespace tests\ClearcodeHQ\CommandBusLauncher;

use ClearcodeHQ\CommandBusLauncher\ArgumentsProcessor;

class ArgumentsProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ArgumentsProcessor
     */
    private $sut;

    /**
     * @tests
     */
    public function it_process_transform_arguments_from_string()
    {
        $arguments = $this->sut->process(['first_arg', 'second_arg']);

        \PHPUnit_Framework_Assert::assertEquals(2, count($arguments));

        \PHPUnit_Framework_Assert::assertEquals('first_arg', $arguments[0]);
        \PHPUnit_Framework_Assert::assertEquals('second_arg', $arguments[1]);
    }

    /**
     * @tests
     */
    public function it_converts_string_numbers_to_integer()
    {
        $arguments = $this->sut->process(['123', 'string_arg']);

        \PHPUnit_Framework_Assert::assertEquals(2, count($arguments));

        \PHPUnit_Framework_Assert::assertEquals(123, $arguments[0]);
        \PHPUnit_Framework_Assert::assertEquals('string_arg', $arguments[1]);
    }

    public function setUp()
    {
        $this->sut = new ArgumentsProcessor();
    }
}
