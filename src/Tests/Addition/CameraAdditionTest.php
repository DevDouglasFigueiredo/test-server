<?php

namespace src\Tests\Addition;

use src\Utils\Utils;
use Facebook\WebDriver\WebDriver;
use PHPUnit\Framework\TestCase;
use src\Tests\PageObject\MainPageObject;

class CameraAdditionTest extends TestCase
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
        $mainPageObject->navigateToAccountSession();
        $mainPageObject->buttonClickToAdd();
        $mainPageObject->fillFieldsAccount("Conta teste","admin@utech.com.br");
        
        $mainPageObject->navigateToDeviceSession();
        $mainPageObject->buttonClickToAdd();
        $mainPageObject->fillFieldsDevice();

        $mainPageObject->navigateToCameraSession();
        $mainPageObject->buttonClickToAdd();
        $mainPageObject->fillFieldsCamera();
        $this->assertStringContainsString(
            "Registro salvo com sucesso!",
            self::$driver->getPageSource(),
            "houve um erro ao salvar o registro"
        );
        $this->assertSame(
            "http://localhost:8080/admin/public/admin/camera",
            self::$driver->getCurrentURL(),
            "houve um erro ao salvar o registro"
        );
    }

    public static function tearDownAfterClass(): void
    {
        self::$driver->close();
    }
}