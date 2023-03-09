<?php

namespace src\Tests\Utils;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Chrome\ChromeOptions;
use src\Tests\Login\PageObject\PageLoginTest;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class Utils
{
    private WebDriver $driver;

    public function testingOpeningChromeBrowser()
    {
        $host = 'http://localhost:4444/wd/hub';
        $capabilities = DesiredCapabilities::chrome();
        $this->driver = RemoteWebDriver::create($host, $capabilities);
    }


    public function testingWithBrowserClosed()
    {
        $host = 'http://localhost:4444/wd/hub';
        $capabilities = DesiredCapabilities::chrome();
        $options = new ChromeOptions();
        $options->addArguments(['headless']);
        $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);
        $this->driver = RemoteWebDriver::create($host, $capabilities);
    }

    
    public function acessingSystemUPN()
    {
        $this->driver->get('http://localhost:8080/admin/public/login');
        $pageLogin = new PageLoginTest($this->driver);
        $pageLogin->fillFieldsAs("admin@utech.com.br", "admin");
        $pageLogin->clickButtonLogin();
    }
    
    public function getDriver(): WebDriver
    {
        return $this->driver;
    }
}
