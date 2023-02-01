<?php

namespace src\Tests\CascadeDeletion;

use src\Utils\Utils;
use src\Functions\Functions;
use src\Utils\ChromeBrowser;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\Login\PageObject\PageLoginTest;
use src\Tests\PageObject\PageCascadeDeletion;
// use src\Tests\CascadeDeletion\PageObject\PageCascadeDeletion;

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
        $pageCascadeDeletion = new PageCascadeDeletion(self::$driver);
        // $pageCascadeDeletion->navigateToAccountSession();
        // $pageCascadeDeletion->buttonClickToAdd();
        // $this->assertStringContainsString(
        //     "Adicionar Conta",
        //     self::$driver->getPageSource()
        // );

        // $pageCascadeDeletion->fillFieldsAccount("Conta teste", "admin@utech.com.br");
        // $this->assertStringContainsString(
        //     "Registro salvo com sucesso!",
        //     self::$driver->getPageSource(),
        //     "houve um erro ao salvar o registro"
        // );

        // $pageCascadeDeletion->navigateToDeviceSession();
        // $pageCascadeDeletion->buttonClickToAdd();
        // $pageCascadeDeletion->fillFieldsDevice();
        // $this->assertEquals(
        //     "Registro salvo com sucesso!",
        //     self::$driver->getPageSource()
        //     // "Equipamento não foi cadastrado"
        // );
        // $this->assertSame(
        //     "http://localhost:8080/admin/public/admin/device/add/",
        //     self::$driver->getCurrentURL()
        // );
        // $this->assertNotSame(
        //     "http://localhost:8080/admin/public/admin/device/",
        //     self::$driver->getCurrentURL()
        // );

        // $pageCascadeDeletion->navigateToCameraSession();
        // $pageCascadeDeletion->buttonClickToAdd();
        // $pageCascadeDeletion->fillFieldsCamera();
        // $this->assertStringContainsString(
        //     "Registro salvo com sucesso!",
        //     self::$driver->getPageSource(),
        //     "houve um erro ao salvar o registro"
        // );
        // $this->assertSame(
        //     "http://localhost:8080/admin/public/admin/camera",
        //     self::$driver->getCurrentURL(),
        //     "houve um erro ao salvar o registro"
        // );

    //     $pageCascadeDeletion->navigateToTokenSession();
    //     $pageCascadeDeletion->buttonClickToAdd();
    //     $pageCascadeDeletion->fillFieldsToken();
    //     $this->assertStringContainsString(
    //         "Registro salvo com sucesso!",
    //         self::$driver->getPageSource(),
    //         "houve um erro ao salvar o registro"
    //     );

    //     $this->assertSame(
    //         "http://localhost:8080/admin/public/admin/token",
    //         self::$driver->getCurrentURL()
    //     );
    //     $this->assertNotSame(
    //         "http://localhost:8080/admin/public/admin/token/add/",
    //         self::$driver->getCurrentURL()
    //     );

    //     $pageCascadeDeletion->navigateToGroupSession();
    //     $pageCascadeDeletion->buttonClickToAdd();
    //     $pageCascadeDeletion->fillFieldsGroup();
    //     $this->assertStringContainsString(
    //         "Registro salvo com sucesso!",
    //         self::$driver->getPageSource(),
    //         "houve um erro ao salvar o registro"
    //     );
    //     $this->assertSame(
    //         "http://localhost:8080/admin/public/admin/group",
    //         self::$driver->getCurrentURL()
    //     );
    //     $this->assertNotSame(
    //         "http://localhost:8080/admin/public/admin/group/add/",
    //         self::$driver->getCurrentURL()
        // );

    }

    // public function testDeletingAccount()
    // {
    //     $pageCascadeDeletion = new PageCascadeDeletion(self::$driver);
    //     $pageCascadeDeletion->clickForDeleteAccount();
    //     $this->assertStringContainsString(
    //         "Registro excluido com sucesso!",
    //         self::$driver->getPageSource(),
    //         "houve um erro ao salvar o registro"
    //     );
    //     $pageCascadeDeletion->navigateToTokenSession();
    //     $this->assertIsNumeric(4, "Dispositivo não removido");

    //     $pageCascadeDeletion->navigateToGroupSession();
    //     $this->assertIsNumeric(3, "Grupo não removido");

    //     $pageCascadeDeletion->navigateToCameraSession();
    //     $this->assertIsNumeric(3, "Câmera não removida");

    //     $pageCascadeDeletion->navigateToDeviceSession();
    //     $this->assertIsNumeric(5, "Equipamento não removido");
    // }

    // public static function tearDownAfterClass(): void
    // {
    //     self::$driver->close();
    // }
}
