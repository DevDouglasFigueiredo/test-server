<?php

namespace src\Utils;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class ChromeBrowser
{
    private WebDriver $driver;

    // public function __construct(WebDriver $driver)
    // {
    //     $this->driver = $driver;
    // }

    public function OpeningChromeBrowser()
    {
        $host = 'http://localhost:4444/wd/hub';
        $capabilities = DesiredCapabilities::chrome();
        $options = new ChromeOptions();
        $options->addArguments(['headless']);
        $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);
        $this->driver = RemoteWebDriver::create($host, $capabilities);
    }

    public function OpeningChromeBrowserWithHost(String $host)
    {
        $capabilities = DesiredCapabilities::chrome();
        $options = new ChromeOptions();
        $options->addArguments(['headless']);
        $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);
        $this->driver = RemoteWebDriver::create($host, $capabilities);
    }

    public function GetDriver() : WebDriver {
        return $this->driver;
    }
}
