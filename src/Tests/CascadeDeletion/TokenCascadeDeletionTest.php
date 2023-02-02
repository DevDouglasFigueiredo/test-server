<?php

namespace src\Tests\CascadeDeletion;

use src\Utils\Utils;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\PageObject\MainPageObject;
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
        $mainPageObject->clickForDeleteToken();
        $this->assertStringContainsString(
            "Registro excluido com sucesso!",
            self::$driver->getPageSource(),
            "Houve um erro ao excluir o registro"
        );
        $mainPageObject->navigateToTokenSession();
        $this->assertIsNumeric(18, "Dispositivo não removido");
        $mainPageObject->navigateToGroupSession();
        $mainPageObject->checkingIfTokenHasBeenDeleted();
        $this->assertStringNotContainsString("teste1 - 1234", self::$driver->getPageSource(), "Dispositivo não removido");
    }

    public static function tearDownAfterClass(): void
    {
        self::$driver->close();
    }
}
