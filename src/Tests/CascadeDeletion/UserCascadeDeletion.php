<?php

namespace src\Tests\CascadeDeletion;

use src\Utils\ChromeBrowser;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\Tests\CascadeDeletion\PageObject\PageCascadeDeletion;
use src\Tests\Login\PageObject\PageLoginTest;

class UserCascadeDeletion extends TestCase
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

    public function testUserCascadeDeletion()
    {
        $accountCascadeDeletion = new AccountCascadeDeletionTest();
        $accountCascadeDeletion->testAccountCascadeDeletion();

        $pageCascadeDeletion = new PageCascadeDeletion(self::$driver);
        
    }
}