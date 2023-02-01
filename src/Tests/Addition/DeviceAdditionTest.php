<?php

namespace src\Tests\Addition;

use src\Utils\Utils;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\PageObject\PageCascadeDeletion;

class DeviceAdditionTest extends TestCase
{
    private static WebDriver $driver;

    public static function setUpBeforeClass(): void
    {
        $utils = new Utils();
        $utils->testingOpeningChromeBrowser();
        // $utils->testingWithBrowserClosed();
        $utils->acessingSystemUPN();
        self::$driver = $utils->getDriver();
    }

    public function testAdditionDevice()
    {
        $pageCascadeDeletion = new PageCascadeDeletion(self::$driver);
        $pageCascadeDeletion->navigateToAccountSession();
        $pageCascadeDeletion->buttonClickToAdd();
        $pageCascadeDeletion->fillFieldsAccount("Conta teste","admin@utech.com.br");
        
        $pageCascadeDeletion->navigateToDeviceSession();
        $pageCascadeDeletion->buttonClickToAdd();
        $pageCascadeDeletion->fillFieldsDevice();
        // // $this->assertEquals(
        // //     "Registro salvo com sucesso!",
        // //     self::$driver->getPageSource(),
        // //     "Equipamento não foi cadastrado"
        // // );
        $this->assertSame(
            "http://localhost:8080/admin/public/admin/device/add/",
            self::$driver->getCurrentURL()
        );
        $this->assertNotSame(
            "http://localhost:8080/admin/public/admin/device/",
            self::$driver->getCurrentURL()
        );
    }
}
