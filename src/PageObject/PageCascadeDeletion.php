<?php

namespace src\PageObject;

use Exception;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use src\Functions\Functions;
use src\Utils\ShortcutElements;

class PageCascadeDeletion extends Functions
{
    private WebDriver $driver;

    public function __construct(WebDriver $driver)
    {
        $this->driver = $driver;
    }

    // public function buttonClickToAdd()
    // {
    //     $addAccount = WebDriverBy::cssSelector("#page-wrapper > div.row.border-bottom.dashboard-header > div:nth-child(1) > div > div > div > a");
    //     $this->driver->findElement($addAccount)->click();
    // }

    // public function clickOnElement($elementToBeClicked)
    // {
    //     $this->driver->findElement($elementToBeClicked)->click();
    // }

    // public function fillField($element, $value)
    // {
    //     $this->driver->findElement($element)->sendKeys($value);
    // }

    // public function chosenIOSPlatform()
    // {
    //     $inputToken = WebDriverBy::cssSelector('input[name = "token"]');
    //     $this->fillField($inputToken, $this->generateNumbers(8));

    //     $inputExtraToken = WebDriverBy::cssSelector('input[name = "extra_token"]');
    //     $this->fillField($inputExtraToken, $this->generateNumbers(10));
    // }

    // public function chosenAndroidPlatform()
    // {
    //     $android = WebDriverBy::cssSelector('option[value = "android"]');
    //     $this->clickOnElement($android);

    //     $inputToken = WebDriverBy::cssSelector('input[name = "token"]');
    //     $this->fillField($inputToken, $this->generateNumbers(10));
    // }

    public function clickToAddAccount()
    {
        $urlAccount = $this->driver->get("http://localhost:8080/admin/public/admin/account/");
        if (!$urlAccount) {
            throw new Exception("Pagina não encontrada");
        }
        $this->buttonClickToAdd();
    }

    public function fillFieldsAccount(string $name, string $email)
    {
        $inputName = WebDriverBy::cssSelector('input[name = "name"]');
        $this->fillField($inputName, $name);

        $inputEmail = WebDriverBy::cssSelector('input[name = "email"]');
        $this->fillField($inputEmail, $email);


        $saveButton = WebDriverBy::cssSelector('input[type = "submit"]');
        $this->clickOnElement($saveButton);
    }

    public function clickToAddDevice()
    {
        $urlDevice = $this->driver->get("http://localhost:8080/admin/public/admin/device/");
        if (!$urlDevice) {
            throw new Exception("Pagina não encontrada");
        }
        $this->buttonClickToAdd();
    }

    public function fillFieldsDevice()
    {

        $inputAccount = WebDriverBy::cssSelector("#general > div:nth-child(2) > div > span > span.selection > span > span.select2-selection__arrow");
        self::clickOnElement($inputAccount);

        $chooseAccount = WebDriverBy::cssSelector('option[value = "19"]');
        $this->clickOnElement($chooseAccount);

        $chooseDevice = WebDriverBy::cssSelector('option[value = "MPI-31EV"]');
        $this->clickOnElement($chooseDevice);

        $inputControl = WebDriverBy::cssSelector("#general > div:nth-child(4) > div > span");
        $this->clickOnElement($inputControl);

        $chooseControls = WebDriverBy::cssSelector('option[value = "4"]');
        $this->clickOnElement($chooseControls);

        $inputName = WebDriverBy::cssSelector('input[name = "name"]');
        $this->fillField($inputName, $this->generateName("Device", 4));

        $inputSerial = WebDriverBy::cssSelector('input[name = "serial"]');
        $this->fillField($inputSerial, $this->generateNumbers(10));

        $saveButtonDevice = WebDriverBy::cssSelector("#device-form > div.form-group > div > a.btn.btn-sm.btn-primary");
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated($saveButtonDevice));
        $this->clickOnElement($saveButtonDevice);
    }


    public function clickToAddCamera()
    {
        $urlCamera = $this->driver->get("http://localhost:8080/admin/public/admin/camera/");
        if (!$urlCamera) {
            throw new Exception("Pagina não encontrada");
        }
        $this->buttonClickToAdd();
    }

    public function fillFieldsCamera()
    {
        $inputAccount = WebDriverBy::cssSelector("#page-wrapper > div.row.border-bottom.dashboard-header > div > div > div > div.ibox-content > form > div:nth-child(1) > div > span > span.selection > span");
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated($inputAccount));
        $this->clickOnElement($inputAccount);

        $chooseAccount = WebDriverBy::cssSelector('option[value = "19"]');
        $this->clickOnElement($chooseAccount);

        $inputDevice = WebDriverBy::cssSelector("#page-wrapper > div.row.border-bottom.dashboard-header > div > div > div > div.ibox-content > form > div:nth-child(2) > div > span > span.selection > span > span.select2-selection__arrow");
        $this->clickOnElement($inputDevice);

        $chooseDevice = WebDriverBy::cssSelector('option[value = "25"]');
        $this->clickOnElement($chooseDevice);
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated($chooseDevice));

        $inputName = WebDriverBy::cssSelector('input[name = "name"]');
        $this->fillField($inputName, $this->generateName("Cam", 4));

        $inputUrl = WebDriverBy::cssSelector('input[name = "url"]');
        $this->fillField($inputUrl, "rtsp://[USER]:[PASSWORD]@[IP]:[PORTA]/cam[STREAM]/h264");

        $chooseInterface = WebDriverBy::cssSelector('option[value = "4"]');
        $this->clickOnElement($chooseInterface);

        $saveButtonCam = WebDriverBy::cssSelector("#page-wrapper > div.row.border-bottom.dashboard-header > div > div > div > div.ibox-content > form > div:nth-child(6) > div > input");
        $this->clickOnElement($saveButtonCam);
    }

    public function clickToAddToken()
    {
        $urlToken = $this->driver->get("http://localhost:8080/admin/public/admin/token/");
        if (!$urlToken) {
            throw new Exception("Pagina não encontrada");
        }
        $this->buttonClickToAdd();
    }

    public function fillFieldsToken()
    {
        $inputAccount = WebDriverBy::cssSelector("#general > div:nth-child(1) > div > span");
        self::clickOnElement($inputAccount);

        $chooseAccount = WebDriverBy::cssSelector('option[value = "19"]');
        $this->clickOnElement($chooseAccount);

        $inputDevice = WebDriverBy::cssSelector("#general > div:nth-child(2) > div > span");
        $this->clickOnElement($inputDevice);

        $chooseDevice = WebDriverBy::cssSelector('option[value = "25"]');
        $this->clickOnElement($chooseDevice);

        $inputName = WebDriverBy::cssSelector('input[name = "name"]');
        $this->fillField($inputName, $this->generateName("Token", 4));

        $inputUuid = WebDriverBy::cssSelector('input[name = "uuid"]');
        $this->fillField($inputUuid, $this->generateNumbers(10));

        $inputUser = WebDriverBy::cssSelector('input[name = "username"]');
        $this->fillField($inputUser, $this->generateNumbers(4));

        $inputPassword = WebDriverBy::cssSelector('input[name = "password"]');
        $this->fillField($inputPassword, "1254");

        $navPlatform = WebDriverBy::xpath('//*[@id="token-form"]/div/ul/li[2]');
        $this->clickOnElement($navPlatform);

        // $this->chosenIOSPlatform();
        $this->chosenAndroidPlatform();

        $savebuttonToken = WebDriverBy::cssSelector("#token-form > div > div > div.form-group > div > a.btn.btn-sm.btn-primary");
        $this->clickOnElement($savebuttonToken);
    }

    public function clickToAddGroup()
    {
        $urlGroup = $this->driver->get("http://localhost:8080/admin/public/admin/group/");
        if (!$urlGroup) {
            throw new Exception("Pagina não encontrada");
        }
        $this->buttonClickToAdd();
    }

    public function fillFieldsGroup()
    {
        $inputAccount = WebDriverBy::cssSelector("#group-form > div:nth-child(2) > div > span > span.selection > span");
        self::clickOnElement($inputAccount);

        $chooseAccount = WebDriverBy::cssSelector('option[value = "19"]');
        $this->clickOnElement($chooseAccount);

        $inputDevice = WebDriverBy::cssSelector("#group-form > div:nth-child(3) > div > span > span.selection > span");
        $this->clickOnElement($inputDevice);

        $chooseDevice = WebDriverBy::cssSelector('option[value = "25"]');
        $this->clickOnElement($chooseDevice);

        $inputName = WebDriverBy::cssSelector('input[name = "name"]');
        $this->fillField($inputName, $this->generateName("Group", 4));

        $buttonAddToken = WebDriverBy::id("btn-add-token");
        $this->clickOnElement($buttonAddToken);

        $inputToken = WebDriverBy::cssSelector("#div-new-token-1 > div.col-md-10.col-sm-9.col-xs-8 > span > span.selection > span");
        $this->clickOnElement($inputToken);

        $chooseToken = WebDriverBy::cssSelector('option[value = "6"]');
        $this->clickOnElement($chooseToken);

        $savebuttonToken = WebDriverBy::id("#submit-btn");
        $this->clickOnElement($savebuttonToken);
        
    }
}
