<?php

namespace src\Tests\VerifyTokenOnDevice\PageObject;

use Exception;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use src\Tests\PageObject\MainPageObject;
use src\Tests\Utils\Functions\Functions;

class PageVerifyTokenOnDevice extends MainPageObject
{
    private WebDriver $driver;

    public function __construct(WebDriver $driver)
    {
        $this->driver = $driver;
    }

    public function fillAdressAPI()
    {
        $function = new Functions($this->driver);

        $navAPI = WebDriverBy::xpath('//*[@id="device-form"]/div[1]/ul/li[2]/a');
        $function->clickOnElement($navAPI);

        $fillURL = WebDriverBy::id("url");
        $function->fillField($fillURL, "10.0.1.181:8080");

        $user = WebDriverBy::id("username");
        $function->fillField($user, "admin");

        $password = WebDriverBy::id("password");
        $function->fillField($password, "1234");

        $btnTestConnection = WebDriverBy::id("btn-test-api");
        $function->clickOnElement($btnTestConnection);

        $deviceTestResult = WebDriverBy::id("device-test-result");
        $assert = $this->driver->findElement($deviceTestResult)->getText();
        if ($assert !== "Dispositivo: MPI-31EBV - Serial: 0000010061 - Versão: 1.1.54") {
            throw new Exception("Dispositivo não encontrado");
        }
    }


    public function visitDeviceUsersPage()
    {
        $this->driver->get("http://10.0.1.181/cgi-bin/index.cgi?/cgi-bin/index.cgi");
    }

    public function doingLoggingOnDevice()
    {
        $function = new Functions($this->driver);

        $inputUser = WebDriverBy::cssSelector('input[name = "gwemail"]');
        $function->fillField($inputUser, "admin");

        $inputPassword = WebDriverBy::cssSelector('input[name = "gwpasswd"]');
        $function->fillField($inputPassword, "admin");

        $btn = WebDriverBy::id("submitbutton");
        $function->clickOnElement($btn);
    }

    // public function checkingIfTokenIsThere()
    // {
    //     $function = new Functions($this->driver);
    //     $mainPageObject = new MainPageObject($this->driver);
        
    //     $menuUser = WebDriverBy::cssSelector("#user > td > a");
    //     $function->clickOnElement($menuUser);

    //     $inputSearch = WebDriverBy::cssSelector('input[name = "filter"]');
    //     $function->fillField($inputSearch,$mainPageObject->getTokenName());
    //     // $function->fillField($inputSearch,$this->getTokenName());


    //     $btnSearch = WebDriverBy::cssSelector('input[name = "user_Search"]');
    //     $function->clickOnElement($btnSearch);
    // }

}