<?php

namespace src\Tests\Addition;

use src\Utils\Utils;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\PageObject\MainPageObject;

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
        $mainPageObject = new MainPageObject(self::$driver);
        $mainPageObject->navigateToAccountSession();
        $mainPageObject->buttonClickToAdd();
        $this->assertStringContainsString(
            "Adicionar Conta",
            self::$driver->getPageSource()
        );

        $mainPageObject->fillFieldsAccount("Conta teste","admin@utech.com.br");
        $this->assertStringContainsString(
            "Registro salvo com sucesso!",
            self::$driver->getPageSource(),
            "houve um erro ao salvar o registro"
        );
    }
    
    public static function tearDownAfterClass(): void
    {
        self::$driver->close();
    }
   
}