<?php

namespace src\Tests\VerifyTokenOnDevice;

use src\Tests\Utils\Utils;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\PageObject\MainPageObject;
use src\Tests\VerifyTokenOnDevice\PageObject\PageVerifyTokenOnDevice;

class VerifyTokenOnDeviceTest extends TestCase
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

    public function testVerifyTokenOnDevice()
    {   $pageVerifyTokenOnDevice = new PageVerifyTokenOnDevice(self::$driver);
        $mainPageObject = new MainPageObject(self::$driver);
        $mainPageObject->navigateToAccountSession();
        $mainPageObject->buttonClickToAdd();
        $mainPageObject->fillFieldsAccount("admin@utech.com.br");
        
        $mainPageObject->navigateToDeviceSession();
        $mainPageObject->buttonClickToAdd();
        $mainPageObject->fillFieldsDevice();
        $pageVerifyTokenOnDevice->fillAdressAPI();
        $mainPageObject->saveButtonDevice();
        
        $this->assertSame(
            "http://localhost:8080/admin/public/admin/device",
            self::$driver->getCurrentURL()
        );
        $this->assertNotSame(
            "http://localhost:8080/admin/public/admin/device/add/",
            self::$driver->getCurrentURL()
        );

        $mainPageObject->navigateToTokenSession();
        $mainPageObject->buttonClickToAdd();
        $mainPageObject->fillFieldsToken();
        
        $this->assertStringContainsString(  
            "Registro salvo com sucesso!",
            self::$driver->getPageSource(),
            "houve um erro ao salvar o registro"
        );

        $this->assertSame(
            "http://localhost:8080/admin/public/admin/token",
            self::$driver->getCurrentURL()
        );
        $this->assertNotSame(
            "http://localhost:8080/admin/public/admin/token/add/",
            self::$driver->getCurrentURL()
        );
        
        $pageVerifyTokenOnDevice->visitDeviceUsersPage();
        $pageVerifyTokenOnDevice->doingLoggingOnDevice();
        $mainPageObject->checkingIfTokenIsThere();
    }

}