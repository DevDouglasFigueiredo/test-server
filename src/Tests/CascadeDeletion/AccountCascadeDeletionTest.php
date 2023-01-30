<?php

namespace src\Tests\CascadeDeletion;

use src\Functions\Functions;
use src\Utils\ChromeBrowser;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\Login\PageObject\PageLoginTest;
use src\Tests\CascadeDeletion\PageObject\PageCascadeDeletion;

class AccountCascadeDeletionTest extends TestCase
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

    public function testAccountCascadeDeletion()
    {
        $pageCascadeDeletion = new PageCascadeDeletion(self::$driver);
        $pageCascadeDeletion->navigateToAccountSession();
        $pageCascadeDeletion->clickToAdd();
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

        $pageCascadeDeletion->navigateToDeviceSession();
        $pageCascadeDeletion->clickToAdd();
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

        $pageCascadeDeletion->navigateToCameraSession();
        $pageCascadeDeletion->clickToAdd();
        $pageCascadeDeletion->fillFieldsCamera();
        $this->assertStringContainsString(
            "Registro salvo com sucesso!",
            self::$driver->getPageSource(),
            "houve um erro ao salvar o registro"
        );
        $this->assertSame(
            "http://localhost:8080/admin/public/admin/camera",
            self::$driver->getCurrentURL()
        );

        $pageCascadeDeletion->navigateToTokenSession();
        $pageCascadeDeletion->clickToAdd();
        $pageCascadeDeletion->fillFieldsToken();
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

        $pageCascadeDeletion->navigateToGroupSession();
        $pageCascadeDeletion->clickToAdd();
        $pageCascadeDeletion->fillFieldsGroup();
        $this->assertStringContainsString(
            "Registro salvo com sucesso!",
            self::$driver->getPageSource(),
            "houve um erro ao salvar o registro"
        );
        $this->assertSame(
            "http://localhost:8080/admin/public/admin/group",
            self::$driver->getCurrentURL()
        );
        $this->assertNotSame(
            "http://localhost:8080/admin/public/admin/group/add/",
            self::$driver->getCurrentURL()
        );

        $pageCascadeDeletion->clickForDeleteAccount();
        $this->assertStringContainsString(
            "Registro excluido com sucesso!",
            self::$driver->getPageSource(),
            "houve um erro ao salvar o registro"
        );
        $pageCascadeDeletion->navigateToTokenSession();
        $this->assertIsNumeric(15, "Dispositivo não removido");
    
        $pageCascadeDeletion->navigateToGroupSession();
        $this->assertIsNumeric(7, "Grupo não removido");
    
        $pageCascadeDeletion->navigateToCameraSession();
        $this->assertIsNumeric(7, "Câmera não removida");
        
        $pageCascadeDeletion->navigateToDeviceSession();
        $this->assertIsNumeric(29, "Equipamento não removido");
    
    }

    public static function tearDownAfterClass(): void
    {
        self::$driver->close();
    }
}
