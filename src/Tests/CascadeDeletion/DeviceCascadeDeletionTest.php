<?php

namespace src\Tests\CascadeDeletion;

use src\Utils\Utils;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\Login\PageObject\PageLoginTest;
use src\Tests\PageObject\MainPageObject;

class DeviceCascadeDeletionTest extends TestCase
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

    public function testDeviceCascadeDeletion()
    {
        $mainPageObject = new MainPageObject(self::$driver);
        $mainPageObject->navigateToAccountSession();
        $mainPageObject->buttonClickToAdd();
        $mainPageObject->fillFieldsAccount("Conta teste", "admin@utech.com.br");
        $mainPageObject->navigateToDeviceSession();
        $mainPageObject->buttonClickToAdd();
        $mainPageObject->fillFieldsDevice();
        $mainPageObject->navigateToCameraSession();
        $mainPageObject->buttonClickToAdd();
        $mainPageObject->fillFieldsCamera();
        $mainPageObject->navigateToTokenSession();
        $mainPageObject->buttonClickToAdd();
        $mainPageObject->fillFieldsToken();
        $mainPageObject->navigateToGroupSession();
        $mainPageObject->buttonClickToAdd();
        $mainPageObject->fillFieldsGroup();
        $mainPageObject->clickForDeleteDevice();
        $this->assertStringContainsString(
            "Registro excluido com sucesso!",
            self::$driver->getPageSource(),
            "houve um erro ao salvar o registro"
        );
        $mainPageObject->navigateToTokenSession();
        $this->assertIsNumeric(18, "Dispositivo não removido");

        $mainPageObject->navigateToGroupSession();
        $this->assertIsNumeric(6, "Grupo não removido");

        $mainPageObject->navigateToCameraSession();
        $this->assertIsNumeric(11, "Câmera não removida");

        $mainPageObject->navigateToDeviceSession();
        $this->assertIsNumeric(25, "Equipamento não removido");

    }

    public static function tearDownAfterClass(): void
    {
        self::$driver->close();
    }
}