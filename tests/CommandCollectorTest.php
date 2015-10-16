<?php

namespace ClearcodeHQ\CommandBusLauncher\Tests;

use ClearcodeHQ\CommandBusLauncher\CommandCollector;
use ClearcodeHQ\CommandBusLauncher\CommandDoesNotExist;
use ClearcodeHQ\CommandBusLauncher\CommandReflection;

class CommandCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**@var CommandCollector */
    private $sut;

    /** @var array */
    private $services;

    /** @test */
    public function it_process_command_services()
    {
        $this->sut->processCommandServices($this->services);

        \PHPUnit_Framework_Assert::assertEquals(
            'InstallInstance',
            $this->sut->getCommandByName('InstallInstance')->commandName
        );

        \PHPUnit_Framework_Assert::assertEquals(
            'ConfirmInstanceInstallation',
            $this->sut->getCommandByName('ConfirmInstanceInstallation')->commandName
        );
    }

    /** @tests */
    public function it_returns_command_reflection_by_command_name()
    {
        $this->sut->processCommandServices($this->services);

        $command = $this->sut->getCommandByName('InstallInstance');

        \PHPUnit_Framework_Assert::assertInstanceOf(CommandReflection::class, $command);
    }

    /**
     * @test
     * @expectedException \ClearcodeHQ\CommandBusLauncher\CommandDoesNotExist
     */
    public function it_throws_exception_when_command_does_not_exist()
    {
        $this->sut->processCommandServices($this->services);

        $this->sut->getCommandByName('UnexistingCommand');
    }

    public function setUp()
    {
        $this->markTestIncomplete();
        $this->sut = new CommandCollector();

        $this->services = [
            'piwik_pro.cloud.command.install_instance' => [
                ['handles' => "PiwikPro\Cloud\Application\Command\InstallInstance"],
            ],
            'piwik_pro.cloud.command.confirm_instance_installation' => [
                ['handles' => "PiwikPro\Cloud\Application\Command\ConfirmInstanceInstallation"],
            ],
        ];
    }
}
