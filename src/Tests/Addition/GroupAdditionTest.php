<?php

namespace src\Tests\Addition;

use src\Utils\Utils;
use Facebook\WebDriver\WebDriver;
use PHPUnit\Framework\TestCase;
use src\Tests\PageObject\MainPageObject;

class GroupAdditionTest extends TestCase
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

    public function testAdditionGroup()
    {
        $mainPageObject = new MainPageObject(self::$driver);
        // $mainPageObject->navigateToAccountSession();
        // $mainPageObject->buttonClickToAdd();
        // $mainPageObject->fillFieldsAccount("Conta teste","admin@utech.com.br");
        
        // $mainPageObject->navigateToDeviceSession();
        // $mainPageObject->buttonClickToAdd();
        // $mainPageObject->fillFieldsDevice();

        // $mainPageObject->navigateToTokenSession();
        // $mainPageObject->buttonClickToAdd();
        // $mainPageObject->fillFieldsToken();

        $mainPageObject->navigateToGroupSession();
        $mainPageObject->buttonClickToAdd();
        $mainPageObject->fillFieldsGroup();
        $this->assertStringContainsString(
            "Registro salvo com sucesso!",
            self::$driver->getPageSource(),
            "houve um erro ao salvar o registro"
        );
        $this->assertSame(
            "http://localhost:8080/admin/public/admin/group/",
            self::$driver->getCurrentURL()
        );
        $this->assertNotSame(
            "http://localhost:8080/admin/public/admin/group/add/",
            self::$driver->getCurrentURL()
        );

    }

    // public static function tearDownAfterClass(): void
    // {
    //     self::$driver->close();
    // }
}