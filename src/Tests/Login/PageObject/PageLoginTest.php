<?php
namespace src\Tests\Login\PageObject;

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use src\Tests\Utils\Functions\Functions;

class PageLoginTest
{
    private WebDriver $driver;

    public function __construct(WebDriver $driver)
    {
        $this->driver = $driver;
    }

    public function fillFieldsAs(string $email, string $password)
    {   
        
        $function = new Functions($this->driver);
        $inputEmail = WebDriverBy::id("loginMail");
        $function->fillField($inputEmail, ['user' => $email]);

        $inputPassword = WebDriverBy::id("loginPass");
        $function->fillField($inputPassword, ['pass' => $password]);

    }

    public function clickButtonLogin()
    {   
        $function = new Functions($this->driver);

        $buttonLogin = WebDriverBy::id("loginButton");
        $function->clickOnElement($buttonLogin);
    }

    public function captchaInvalid(string $valueCaptcha)
    {   
        $function = new Functions($this->driver);

        $inputCaptcha = WebDriverBy::id("captchaInput");
        $function->fillField($inputCaptcha, $valueCaptcha);
    }
}
