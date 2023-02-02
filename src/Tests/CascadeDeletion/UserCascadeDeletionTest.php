<?php

namespace src\Tests\CascadeDeletion;

use src\Utils\Utils;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\Login\PageObject\PageLoginTest;
use src\Tests\PageObject\MainPageObject;

class UserCascadeDeletionTest extends TestCase
{
    private static WebDriver $driver;
    private PageLoginTest $pageLogin;

    public static function setUpBeforeClass(): void
    {
        $utils = new Utils();
        $utils->testingOpeningChromeBrowser();
        // $utils->testingWithBrowserClosed();
        $utils->acessingSystemUPN();
        self::$driver = $utils->getDriver();
    }

    public function testUserCascadeDeletion()
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
        $mainPageObject->clickForDeleteUser();
        $this->assertStringContainsString(
            "Registro excluido com sucesso!",
            self::$driver->getPageSource(),
            "houve um erro ao salvar o registro"
        );
        $mainPageObject->navigateToTokenSession();
        $this->assertIsNumeric(4, "Dispositivo não removido");

        $mainPageObject->navigateToGroupSession();
        $this->assertIsNumeric(3, "Grupo não removido");

        $mainPageObject->navigateToCameraSession();
        $this->assertIsNumeric(3, "Câmera não removida");

        $mainPageObject->navigateToDeviceSession();
        $this->assertIsNumeric(5, "Equipamento não removido");

        $mainPageObject->navigateToAccountSession();
        $this->assertIsNumeric(5, "Conta não removida");
    }

    public static function tearDownAfterClass(): void
    {
        self::$driver->close();
    }
}