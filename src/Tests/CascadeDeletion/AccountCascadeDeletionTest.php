<?php

namespace src\Tests\CascadeDeletion;

use src\Utils\Utils;
use src\Functions\Functions;
use src\Utils\ChromeBrowser;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\Login\PageObject\PageLoginTest;
use src\Tests\PageObject\MainPageObject;

class AccountCascadeDeletionTest extends TestCase
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


    public function testAccountCascadeDeletion()
    {
        $mainPageObject = new MainPageObject(self::$driver);
        $mainPageObject->navigateToAccountSession();
        $mainPageObject->buttonClickToAdd();
        $this->assertStringContainsString(
            "Adicionar Conta",
            self::$driver->getPageSource()
        );

        $mainPageObject->fillFieldsAccount("Conta teste", "admin@utech.com.br");
        $this->assertStringContainsString(
            "Registro salvo com sucesso!",
            self::$driver->getPageSource(),
            "houve um erro ao salvar o registro"
        );

        $mainPageObject->navigateToDeviceSession();
        $mainPageObject->buttonClickToAdd();
        $mainPageObject->fillFieldsDevice();
        $this->assertEquals(
            "Registro salvo com sucesso!",
            self::$driver->getPageSource()
            // "Equipamento não foi cadastrado"
        );
        $this->assertSame(
            "http://localhost:8080/admin/public/admin/device/add/",
            self::$driver->getCurrentURL()
        );
        $this->assertNotSame(
            "http://localhost:8080/admin/public/admin/device/",
            self::$driver->getCurrentURL()
        );

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

        $mainPageObject->navigateToTokenSession();
        $mainPageObject->buttonClickToAdd();
        $mainPageObject->fillFieldsToken();
        $this->assertStringContainsString(
            "Registro salvo com sucesso!",
            self::$driver->getPageSource(),
            "houve um erro ao salvar o registro"
        );

        $this->assertSame(
            "http://localhost:8080/admin/public/admin/token",
            self::$driver->getCurrentURL()
        );
        $this->assertNotSame(
            "http://localhost:8080/admin/public/admin/token/add/",
            self::$driver->getCurrentURL()
        );

        $mainPageObject->navigateToGroupSession();
        $mainPageObject->buttonClickToAdd();
        $mainPageObject->fillFieldsGroup();
        $this->assertStringContainsString(
            "Registro salvo com sucesso!",
            self::$driver->getPageSource(),
            "houve um erro ao salvar o registro"
        );
        $this->assertSame(
            "http://localhost:8080/admin/public/admin/group",
            self::$driver->getCurrentURL()
        );
        $this->assertNotSame(
            "http://localhost:8080/admin/public/admin/group/add/",
            self::$driver->getCurrentURL()
        );

    }

    public function testDeletingAccount()
    {
        $mainPageObject = new MainPageObject(self::$driver);
        $mainPageObject->clickForDeleteAccount();
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
    }

    public static function tearDownAfterClass(): void
    {
        self::$driver->close();
    }
}
