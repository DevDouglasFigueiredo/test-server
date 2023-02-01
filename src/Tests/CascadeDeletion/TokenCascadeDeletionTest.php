<?php

namespace src\Tests\CascadeDeletion;

use src\Utils\Utils;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\PageObject\PageCascadeDeletion;
use src\Tests\CascadeDeletion\AccountCascadeDeletionTest;

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

    public function testTokenCascadeDeletion()
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
        $this->assertStringNotContainsString("teste1 - 1234", self::$driver->getPageSource(), "Dispositivo não removido");
    }
}
