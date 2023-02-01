<?php

namespace src\Tests\CascadeDeletion;

use src\Utils\Utils;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\Login\PageObject\PageLoginTest;
use src\Tests\PageObject\PageCascadeDeletion;
// use src\Tests\CascadeDeletion\PageObject\PageCascadeDeletion;

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
        $pageCascadeDeletion = new PageCascadeDeletion(self::$driver);
        $pageCascadeDeletion->navigateToAccountSession();
        $pageCascadeDeletion->buttonClickToAdd();
        $pageCascadeDeletion->fillFieldsAccount("Conta teste", "admin@utech.com.br");
        $pageCascadeDeletion->navigateToDeviceSession();
        $pageCascadeDeletion->buttonClickToAdd();
        $pageCascadeDeletion->fillFieldsDevice();
        $pageCascadeDeletion->navigateToCameraSession();
        $pageCascadeDeletion->buttonClickToAdd();
        $pageCascadeDeletion->fillFieldsCamera();
        $pageCascadeDeletion->navigateToTokenSession();
        $pageCascadeDeletion->buttonClickToAdd();
        $pageCascadeDeletion->fillFieldsToken();
        $pageCascadeDeletion->navigateToGroupSession();
        $pageCascadeDeletion->buttonClickToAdd();
        $pageCascadeDeletion->fillFieldsGroup();
        $pageCascadeDeletion->clickForDeleteUser();
        $this->assertStringContainsString(
            "Registro excluido com sucesso!",
            self::$driver->getPageSource(),
            "houve um erro ao salvar o registro"
        );
        $pageCascadeDeletion->navigateToTokenSession();
        $this->assertIsNumeric(4, "Dispositivo não removido");

        $pageCascadeDeletion->navigateToGroupSession();
        $this->assertIsNumeric(3, "Grupo não removido");

        $pageCascadeDeletion->navigateToCameraSession();
        $this->assertIsNumeric(3, "Câmera não removida");

        $pageCascadeDeletion->navigateToDeviceSession();
        $this->assertIsNumeric(5, "Equipamento não removido");

        $pageCascadeDeletion->navigateToAccountSession();
        $this->assertIsNumeric(5, "Conta não removida");
    }
}