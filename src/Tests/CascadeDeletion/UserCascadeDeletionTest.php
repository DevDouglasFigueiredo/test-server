<?php

namespace src\Tests\CascadeDeletion;

use src\Utils\Utils;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\Login\PageObject\PageLoginTest;
use src\Tests\CascadeDeletion\PageObject\PageCascadeDeletion;

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
        $accountCascadeDeletion = new AccountCascadeDeletionTest();
        $accountCascadeDeletion->testAccountCascadeDeletion();

        $pageCascadeDeletion = new PageCascadeDeletion(self::$driver);
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