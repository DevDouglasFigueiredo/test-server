<?php

namespace src\Tests\Login;

use src\Utils\ChromeBrowser;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use src\Tests\Login\PageObject\PageLoginTest;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class LoginTest extends TestCase
{
  private static WebDriver $driver;
  private PageLoginTest $pageLogin;


  public static function setUpBeforeClass(): void
  {

    $chromeBrowser = new ChromeBrowser();
    // $chromeBrowser->testingOpeningChromeBrowser();
    $chromeBrowser->testingWithBrowserClosed();
    self::$driver = $chromeBrowser->getDriver();
  }

  protected function setUp(): void
  {
    self::$driver->get('http://localhost:8080/admin/public/login');
    $this->pageLogin = new PageLoginTest(self::$driver);
  }

  /**
   * @dataProvider dataTestLoginWithErrors
   */

  public function testLoginWithErrors($user, $pass)
  {
    $this->pageLogin->fillFieldsAs($user, $pass);
    $this->pageLogin->clickButtonLogin();
    $this->assertStringContainsString(
      "Ops!",
      self::$driver->getPageSource(),
      "Mensagem de Login inválido não apresentada"
    );

    $this->assertStringNotContainsString(
      "Perfis de Usuários",
      self::$driver->getPageSource()
    );
    $this->assertSame(
      "http://localhost:8080/admin/public/login",
      self::$driver->getCurrentURL()
    );
  }


  public function testLoginSucess()
  {
    $this->pageLogin->fillFieldsAs("admin@utech.com.br", "admin");
    $this->pageLogin->clickButtonLogin();
    $this->assertSame(
      "http://localhost:8080/admin/public/admin/user",
      self::$driver->getCurrentURL()
    );

    $this->assertNotSame(
      "http://localhost:8080/admin/public/login",
      self::$driver->getCurrentURL()
    );

    $this->assertStringContainsString(
      "Usuários",
      self::$driver->getPageSource(),
      "Menu de usuários não apresentado"
    );
  }

  public function dataTestLoginWithErrors(): array
  {

    return [
      'UsuarioInexistente' => ['email@gmail.com', 'senha001'],
      'loginComUsuarioInvalido' => ['email@gmail.com', 'admin'],
      'loginComSenhaInvalida' => ['admin@utech.com.br', '123456789'],
    ];
  }

  public static function tearDownAfterClass(): void
  {
    self::$driver->close();
  }
}
