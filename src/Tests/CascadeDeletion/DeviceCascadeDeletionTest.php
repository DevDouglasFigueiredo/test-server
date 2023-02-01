<?php

namespace src\Tests\CascadeDeletion;

use src\Utils\Utils;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\Login\PageObject\PageLoginTest;
use src\Tests\CascadeDeletion\PageObject\PageCascadeDeletion;

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
        // $accountCascadeDeletion = new AccountCascadeDeletionTest();
        // $accountCascadeDeletion->testAccountCascadeDeletion();

        $pageCascadeDeletion = new PageCascadeDeletion(self::$driver);
        $pageCascadeDeletion->clickForDeleteDevice();
        $this->assertStringContainsString(
            "Registro excluido com sucesso!",
            self::$driver->getPageSource(),
            "houve um erro ao salvar o registro"
        );
        $pageCascadeDeletion->navigateToTokenSession();
        $this->assertIsNumeric(18, "Dispositivo não removido");

        $pageCascadeDeletion->navigateToGroupSession();
        $this->assertIsNumeric(6, "Grupo não removido");

        $pageCascadeDeletion->navigateToCameraSession();
        $this->assertIsNumeric(11, "Câmera não removida");

        $pageCascadeDeletion->navigateToDeviceSession();
        $this->assertIsNumeric(25, "Equipamento não removido");

    }
}