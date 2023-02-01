<?php


namespace src\Tests\CascadeDeletion\PageObject;

use Exception;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverWait;
use src\Tests\CascadeDeletion\Functions\Functions;
use src\Utils\ShortcutElements;

class PageCascadeDeletion extends Functions
{
    private WebDriver $driver;

    
    public function __construct(WebDriver $driver)
    {
        $this->driver = $driver;
    }

    public function buttonClickToAdd()
    {
        $addAccount = WebDriverBy::cssSelector("#page-wrapper > div.row.border-bottom.dashboard-header > div:nth-child(1) > div > div > div > a");
        $this->driver->findElement($addAccount)->click();
    }

    public function chosenIOSPlatform()
    {
        $function = new Functions($this->driver);
        $inputToken = WebDriverBy::cssSelector('input[name = "token"]');
        $function->fillField($inputToken, $function->generateNumbers(8));

        $inputExtraToken = WebDriverBy::cssSelector('input[name = "extra_token"]');
        $function->fillField($inputExtraToken, $function->generateNumbers(10));
    }

    public function chosenAndroidPlatform()
    {   
        $function = new Functions($this->driver);
        $android = WebDriverBy::cssSelector('option[value = "android"]');
        $function->clickOnElement($android);

        $inputToken = WebDriverBy::cssSelector('input[name = "token"]');
        $function->fillField($inputToken, $function->generateNumbers(10));
    }

    public function navigateToUserSession()
    {
        $urlUser = $this->driver->get("http://localhost:8080/admin/public/admin/user/");
        if (!$urlUser) {
            throw new Exception("Pagina não encontrada");
        }
    }

    public function navigateToAccountSession()
    {
        $urlAccount = $this->driver->get("http://localhost:8080/admin/public/admin/account/");
        if (!$urlAccount) {
            throw new Exception("Pagina não encontrada");
        }
    }

    public function navigateToDeviceSession()
    {
        $urlAccount = $this->driver->get("http://localhost:8080/admin/public/admin/device/");
        if (!$urlAccount) {
            throw new Exception("Pagina não encontrada");
        }
    }

    public function navigateToCameraSession()
    {
        $urlAccount = $this->driver->get("http://localhost:8080/admin/public/admin/camera/");
        if (!$urlAccount) {
            throw new Exception("Pagina não encontrada");
        }
    }

    public function navigateToTokenSession()
    {
        $urlAccount = $this->driver->get("http://localhost:8080/admin/public/admin/token");
        if (!$urlAccount) {
            throw new Exception("Pagina não encontrada");
        }
    }

    public function navigateToGroupSession()
    {
        $urlAccount = $this->driver->get("http://localhost:8080/admin/public/admin/group/");
        if (!$urlAccount) {
            throw new Exception("Pagina não encontrada");
        }
    }

    public function fillFieldsAccount(string $name, string $email)
    {
        $function = new Functions($this->driver);
        $inputName = WebDriverBy::cssSelector('input[name = "name"]');
        $function->fillField($inputName, $name);

        $inputEmail = WebDriverBy::cssSelector('input[name = "email"]');
        $function->fillField($inputEmail, $email);

        $saveButton = WebDriverBy::cssSelector('input[type = "submit"]');
        $function->clickOnElement($saveButton);
    }


    public function fillFieldsDevice()
    {
        $function = new Functions($this->driver);
        $inputAccount = WebDriverBy::cssSelector("#general > div:nth-child(2) > div > span > span.selection > span > span.select2-selection__arrow");
        $function->clickOnElement($inputAccount);

        $chooseAccount = WebDriverBy::cssSelector('option[value = "11" ]');
        $function->clickOnElement($chooseAccount);

        $chooseDevice = WebDriverBy::cssSelector('option[value = "MPI-31EV"]');
        $function->clickOnElement($chooseDevice);

        $inputControl = WebDriverBy::cssSelector("#general > div:nth-child(4) > div > span");
        $function->clickOnElement($inputControl);

        $chooseControls = WebDriverBy::cssSelector('option[value = "2"]');
        $function->clickOnElement($chooseControls);

        $inputName = WebDriverBy::cssSelector('input[name = "name"]');
        $function->fillField($inputName, $function->generateName("Device", 4));

        $inputSerial = WebDriverBy::cssSelector('input[name = "serial"]');
        $function->fillField($inputSerial, $function->generateNumbers(10));

        $saveButtonDevice = WebDriverBy::cssSelector("#device-form > div.form-group > div > a.btn.btn-sm.btn-primary");
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated($saveButtonDevice));
        $function->clickOnElement($saveButtonDevice);
    }


    public function fillFieldsCamera()
    {   
        $function = new Functions($this->driver);
        $inputAccount = WebDriverBy::cssSelector("#page-wrapper > div.row.border-bottom.dashboard-header > div > div > div > div.ibox-content > form > div:nth-child(1) > div > span > span.selection > span");
        // $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated($inputAccount));
        $function->clickOnElement($inputAccount);

        $chooseAccount = WebDriverBy::cssSelector('option[value = "11"]');
        $function->clickOnElement($chooseAccount);

        $inputDevice = WebDriverBy::cssSelector("#page-wrapper > div.row.border-bottom.dashboard-header > div > div > div > div.ibox-content > form > div:nth-child(2) > div > span > span.selection > span > span.select2-selection__arrow");
        $function->clickOnElement($inputDevice);

        $chooseDevice = WebDriverBy::cssSelector('option[value = "26"]');
        $function->clickOnElement($chooseDevice);

        $inputName = WebDriverBy::cssSelector('input[name = "name"]');
        $function->fillField($inputName, $function->generateName("Cam", 4));

        $inputUrl = WebDriverBy::cssSelector('input[name = "url"]');
        $function->fillField($inputUrl, "rtsp://[USER]:[PASSWORD]@[IP]:[PORTA]/cam[STREAM]/h284");

        $chooseInterface = WebDriverBy::cssSelector('option[value = "1"]');
        $function->clickOnElement($chooseInterface);

        $saveButtonCam = WebDriverBy::cssSelector("#page-wrapper > div.row.border-bottom.dashboard-header > div > div > div > div.ibox-content > form > div:nth-child(6) > div > input");
        $function->clickOnElement($saveButtonCam);
    }

    public function fillFieldsToken()
    {   
        $function = new Functions($this->driver);
        $inputAccount = WebDriverBy::cssSelector("#general > div:nth-child(1) > div > span");
        $function->clickOnElement($inputAccount);

        $chooseAccount = WebDriverBy::cssSelector('option[value = "9"]');
        $function->clickOnElement($chooseAccount);

        $inputDevice = WebDriverBy::cssSelector("#general > div:nth-child(2) > div > span");
        $function->clickOnElement($inputDevice);

        $chooseDevice = WebDriverBy::cssSelector('option[value = "16"]');
        $function->clickOnElement($chooseDevice);

        $inputName = WebDriverBy::cssSelector('input[name = "name"]');
        $function->fillField($inputName, $function->generateName("Token", 4));

        $inputUuid = WebDriverBy::cssSelector('input[name = "uuid"]');
        $function->fillField($inputUuid, $function->generateNumbers(10));

        $inputUser = WebDriverBy::cssSelector('input[name = "username"]');
        $function->fillField($inputUser, $function->generateNumbers(4));

        $inputPassword = WebDriverBy::cssSelector('input[name = "password"]');
        $function->fillField($inputPassword, "1284");

        $navPlatform = WebDriverBy::xpath('//*[@id="token-form"]/div/ul/li[2]');
        $function->clickOnElement($navPlatform);

        // $this->chosenIOSPlatform();
        $this->chosenAndroidPlatform();

        $savebuttonToken = WebDriverBy::cssSelector("#token-form > div > div > div.form-group > div > a.btn.btn-sm.btn-primary");
        $function->clickOnElement($savebuttonToken);
    }


    public function fillFieldsGroup()
    {   
        $function = new Functions($this->driver);
        $inputAccount = WebDriverBy::cssSelector("#group-form > div:nth-child(2) > div > span > span.selection > span");
        $function->clickOnElement($inputAccount);

        $chooseAccount = WebDriverBy::cssSelector('option[value = "8"]');
        $function->clickOnElement($chooseAccount);

        $inputDevice = WebDriverBy::cssSelector("#group-form > div:nth-child(3) > div > span > span.selection > span");
        $function->clickOnElement($inputDevice);

        $chooseDevice = WebDriverBy::cssSelector('option[value = "6"]');
        $function->clickOnElement($chooseDevice);

        $inputName = WebDriverBy::cssSelector('input[name = "name"]');
        $function->fillField($inputName, $function->generateName("Group", 4));

        $buttonAddToken = WebDriverBy::id("btn-add-token");
        $function->clickOnElement($buttonAddToken);

        $chooseToken = WebDriverBy::cssSelector('option[value = "5"]');
        $function->clickOnElement($chooseToken);

        $savebuttonToken = WebDriverBy::id("submit-btn");
        $function->clickOnElement($savebuttonToken);
    }

    public function clickForDeleteAccount()
    {   
        $function = new Functions($this->driver);
        $this->driver->get("http://localhost:8080/admin/public/admin/account/");

        $trash = WebDriverBy::cssSelector("#page-wrapper > div.row.border-bottom.dashboard-header > div:nth-child(3) > div > div > div.ibox-content > table > tbody > tr > td:nth-child(8) > a.upn-btn-actions.upn-btn-delete > i");
        $function->clickOnElement($trash);

        $this->driver->manage()->timeouts()->implicitlyWait(5);

        $buttonDelete = WebDriverBy::id("btn-confirm-delete");
        $function->clickOnElement($buttonDelete);
    }

    public function clickForDeleteUser()
    {   
        $function = new Functions($this->driver);
        $this->driver->get("http://localhost:8080/admin/public/admin/user/");

        $trash = WebDriverBy::cssSelector("#page-wrapper > div.row.border-bottom.dashboard-header > div:nth-child(3) > div > div > div.ibox-content > table > tbody > tr > td:nth-child(5) > a.upn-btn-actions.upn-btn-delete > i");
        $function->clickOnElement($trash);

        $this->driver->manage()->timeouts()->implicitlyWait(5);

        $buttonDelete = WebDriverBy::id("btn-confirm-delete");
        $function->clickOnElement($buttonDelete);
    }

    public function clickForDeleteDevice()
    {   
        $function = new Functions($this->driver);
        $this->driver->get("http://localhost:8080/admin/public/admin/device/");

        $trash = WebDriverBy::cssSelector("#page-wrapper > div.row.border-bottom.dashboard-header > div:nth-child(3) > div > div > div.ibox-content > table > tbody > tr > td:nth-child(6) > a.upn-btn-actions.upn-btn-delete > i");
        $function->clickOnElement($trash);

        $this->driver->manage()->timeouts()->implicitlyWait(5);

        $buttonDelete = WebDriverBy::id("btn-confirm-delete");
        $function->clickOnElement($buttonDelete);
    }

    public function clickForDeleteToken()
    {
        $function = new Functions($this->driver);
        $this->driver->get("http://localhost:8080/admin/public/admin/token/");

        $trash = WebDriverBy::cssSelector("#page-wrapper > div.row.border-bottom.dashboard-header > div:nth-child(3) > div > div > div.ibox-content > table > tbody > tr:nth-child(1) > td:nth-child(8) > a.upn-btn-actions.upn-btn-delete > i");
        $function->clickOnElement($trash);

        $this->driver->manage()->timeouts()->implicitlyWait(5);

        $buttonDelete = WebDriverBy::id("btn-confirm-delete");
        $function->clickOnElement($buttonDelete);
    }

    public function checkingIfTokenHasBeenDeleted()
    {   
        $function = new Functions($this->driver);
        $buttonEditToken = WebDriverBy::cssSelector("#page-wrapper > div.row.border-bottom.dashboard-header > div:nth-child(3) > div > div > div.ibox-content > table > tbody > tr > td:nth-child(6) > a:nth-child(1) > i");
        $function->clickOnElement($buttonEditToken);
        
    }
}
