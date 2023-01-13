<?php

namespace src\Tests\Login;

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use src\PageObject\PageLoginTest;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use src\Utils\ChromeBrowser;

class LoginTestCaptchaOn extends TestCase
{
    private static WebDriver $driver;
    private PageLoginTest $pageLogin;
   
  
    public static function setUpBeforeClass(): void
    {
      
      $chromeBrowser = new ChromeBrowser();
      $chromeBrowser->OpeningChromeBrowser();
      self::$driver = $chromeBrowser->GetDriver();
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