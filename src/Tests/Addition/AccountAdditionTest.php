<?php

namespace src\Tests\Addition;

use src\Utils\Utils;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\PageObject\PageCascadeDeletion;

class AccountAdditionTest extends TestCase
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

    public function testAdditionAccount()
    {
        $pageCascadeDeletion = new PageCascadeDeletion(self::$driver);
        $pageCascadeDeletion->navigateToAccountSession();
        $pageCascadeDeletion->buttonClickToAdd();
        $this->assertStringContainsString(
            "Adicionar Conta",
            self::$driver->getPageSource()
        );

        $pageCascadeDeletion->fillFieldsAccount("Conta teste", "admin@utech.com.br");
        $this->assertStringContainsString(
            "Registro salvo com sucesso!",
            self::$driver->getPageSource(),
            "houve um erro ao salvar o registro"
        );
    }
}