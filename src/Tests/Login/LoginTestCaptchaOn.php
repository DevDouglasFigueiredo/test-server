<?php

namespace src\Tests\Login;

use src\Utils\ChromeBrowser;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use src\Tests\Login\PageObject\PageLoginTest;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class LoginTestCaptchaOn extends TestCase
{
    private static WebDriver $driver;
    private PageLoginTest $pageLogin;
   
  
    public static function setUpBeforeClass(): void
    {
      
      $chromeBrowser = new ChromeBrowser();
      $chromeBrowser->testingOpeningChromeBrowser();
      self::$driver = $chromeBrowser->getDriver();
    }
    
    protected function setUp(): void
    {
      
      self::$driver->get('http://localhost:8080/admin/public/login');
      $this->pageLogin = new PageLoginTest(self::$driver);
    }

    public function testCaptchaInvalid()
  { 

    $this->pageLogin->fillFieldsAs("user@email.com", "password");
    $this->pageLogin->captchaInvalid("aaaa");
    $this->pageLogin->clickButtonLogin();
    $this->assertStringContainsString("Captcha inválido", self::$driver->getPageSource());
    $this->assertSame(
        "http://localhost:8080/admin/public/login",
        self::$driver->getCurrentURL()
      );
  }

  public static function tearDownAfterClass(): void
  {
    self::$driver->close();
  }

}