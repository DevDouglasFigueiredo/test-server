<?php

namespace src\Tests\Addition;

use src\Utils\Utils;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\PageObject\MainPageObject;

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
        $mainPageObject = new MainPageObject(self::$driver);
        // $mainPageObject->navigateToAccountSession();
        // $mainPageObject->buttonClickToAdd();
        // $mainPageObject->fillFieldsAccount("Conta teste","admin@utech.com.br");
        
        $mainPageObject->navigateToDeviceSession();
        $mainPageObject->buttonClickToAdd();
        $mainPageObject->fillFieldsDevice();
        $this->assertSame(
            "http://localhost:8080/admin/public/admin/device/add/",
            self::$driver->getCurrentURL()
        );
        $this->assertNotSame(
            "http://localhost:8080/admin/public/admin/device/",
            self::$driver->getCurrentURL()
        );
        // // $this->assertEquals(
        // //     "Registro salvo com sucesso!",
        // //     self::$driver->getPageSource(),
        // //     "Equipamento não foi cadastrado"
        // // );
    }

    public static function tearDownAfterClass(): void
    {
        self::$driver->close();
    }
}
