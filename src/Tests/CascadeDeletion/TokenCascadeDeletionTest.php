<?php

namespace src\Tests\CascadeDeletion;

use src\Utils\Utils;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\CascadeDeletion\AccountCascadeDeletionTest;
use src\Tests\CascadeDeletion\PageObject\PageCascadeDeletion;

class TokenCascadeDeletionTest extends TestCase
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
        // $accountCascadeDeletion = new AccountCascadeDeletionTest();
        // $accountCascadeDeletion->testAccountCascadeDeletion();

        $pageCascadeDeletion = new PageCascadeDeletion(self::$driver);
        $pageCascadeDeletion->clickForDeleteToken();
        $this->assertStringContainsString(
            "Registro excluido com sucesso!",
            self::$driver->getPageSource(),
            "Houve um erro ao excluir o registro"
        );
        $pageCascadeDeletion->navigateToTokenSession();
        $this->assertIsNumeric(18, "Dispositivo não removido");
        $pageCascadeDeletion->navigateToGroupSession();
        $pageCascadeDeletion->checkingIfTokenHasBeenDeleted();
        $this->assertStringContainsString("teste1 - 1111",self::$driver->getPageSource(), "Dispositivo não removido");

    }

}