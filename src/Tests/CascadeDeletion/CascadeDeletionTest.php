<?php

namespace src\Tests\CascadeDeletion;

use src\Utils\ChromeBrowser;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Functions\Functions;
use src\PageObject\PageCascadeDeletion;
use src\PageObject\PageLoginTest;

class CascadeDeletionTest extends TestCase
{
    private static WebDriver $driver;
    private PageLoginTest $pageLogin;

    public static function setUpBeforeClass(): void
    {
        $chromeBrowser = new ChromeBrowser();
        $chromeBrowser->testingOpeningChromeBrowser();
        // $chromeBrowser->testingWithBrowserClosed();
        self::$driver = $chromeBrowser->getDriver();
    }

    protected function setUp(): void
    {
        self::$driver->get('http://localhost:8080/admin/public/login');
        $this->pageLogin = new PageLoginTest(self::$driver);
        $this->pageLogin->fillFieldsAs("admin@utech.com.br", "admin");
        $this->pageLogin->clickButtonLogin();
    }

    public function testTopDownCascadeDeletion()
    {
        $pageCascadeDeletion = new PageCascadeDeletion(self::$driver);
        $pageCascadeDeletion->clickToAddAccount();
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

        $pageCascadeDeletion->clickToAddDevice();
        $pageCascadeDeletion->fillFieldsDevice();
        // // $this->assertStringContainsString(
        // //     "Registro salvo com sucesso!",
        // //     self::$driver->getPageSource(),
        // //     "mensagem nao visualizada"
        // // );
        $this->assertSame(
            "http://localhost:8080/admin/public/admin/device/add/",
            self::$driver->getCurrentURL()
        );
        $this->assertNotSame(
            "http://localhost:8080/admin/public/admin/device/",
            self::$driver->getCurrentURL()
        );

        // $pageCascadeDeletion->clickToAddCamera();
        // $pageCascadeDeletion->fillFieldsCamera();
        // $this->assertStringContainsString(
        //     "Registro salvo com sucesso!",
        //     self::$driver->getPageSource(),
        //     "houve um erro ao salvar o registro"
        // );
        // $this->assertSame(
        //     "http://localhost:8080/admin/public/admin/camera",
        //     self::$driver->getCurrentURL()
        // );

        // $pageCascadeDeletion->clickToAddToken();
        // $pageCascadeDeletion->fillFieldsToken();
        // $this->assertStringContainsString(
        //     "Registro salvo com sucesso!",
        //     self::$driver->getPageSource(),
        //     "houve um erro ao salvar o registro"
        // );

        // $this->assertSame(
        //     "http://localhost:8080/admin/public/admin/token",
        //     self::$driver->getCurrentURL()
        // );
        // $this->assertNotSame(
        //     "http://localhost:8080/admin/public/admin/token/add/",
        //     self::$driver->getCurrentURL()
        // );

        // $pageCascadeDeletion->clickToAddGroup();
        // $pageCascadeDeletion->fillFieldsGroup();
    }

    // public static function tearDownAfterClass(): void
    // {
    //     self::$driver->close();
    // }
}
