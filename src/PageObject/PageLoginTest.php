<?php

namespace src\PageObject;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverExpectedCondition;

class PageLoginTest
{
    private WebDriver $driver;

    public function __construct(WebDriver $driver)
    {
        $this->driver = $driver;
    }

    // public function OpeningChromeBrowser()
    // {
    //     $host = 'http://localhost:4444/wd/hub';
    //     $capabilities = DesiredCapabilities::chrome();
    //     // self::$driver = RemoteWebDriver::create($host, $capabilities);
    //     $options = new ChromeOptions();
    //     $options->addArguments(['headless']);
    //     $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);
    //     $this->driver = RemoteWebDriver::create($host, $capabilities);
    // }

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
