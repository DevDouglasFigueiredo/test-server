<?php
namespace src\Tests\Login\PageObject;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;

class PageLoginTest
{
    private WebDriver $driver;

    public function __construct(WebDriver $driver)
    {
        $this->driver = $driver;
    }

    public function fillFieldsAs(string $email, string $password)
    {
        $inputEmail = WebDriverBy::id("loginMail");
        $this->driver->findElement($inputEmail)->sendKeys(['user' => $email]);

        $inputPassword = WebDriverBy::id("loginPass");
        $this->driver->findElement($inputPassword)->sendKeys(['pass' => $password]);

    }

    public function clickButtonLogin()
    {
        $buttonLogin = WebDriverBy::id("loginButton");
        $this->driver->findElement($buttonLogin)->click();
    }

    public function captchaInvalid(string $valueCaptcha)
    {
        $inputCaptcha = WebDriverBy::id("captchaInput");
        $this->driver->findElement($inputCaptcha)->sendKeys($valueCaptcha);
    }
}
