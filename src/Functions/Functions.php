<?php

namespace src\Functions;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;

class Functions
{
    private WebDriver $driver;

    public function buttonClickToAdd()
    {
        $addAccount = WebDriverBy::cssSelector("#page-wrapper > div.row.border-bottom.dashboard-header > div:nth-child(1) > div > div > div > a");
        $this->driver->findElement($addAccount)->click();
    }

    public function clickOnElement($elementToBeClicked)
    {
        $this->driver->findElement($elementToBeClicked)->click();
    }

    public function fillField($element, $value)
    {
        $this->driver->findElement($element)->sendKeys($value);
    }

    public function chosenIOSPlatform()
    {
        $inputToken = WebDriverBy::cssSelector('input[name = "token"]');
        $this->fillField($inputToken, $this->generateNumbers(8));

        $inputExtraToken = WebDriverBy::cssSelector('input[name = "extra_token"]');
        $this->fillField($inputExtraToken, $this->generateNumbers(10));
    }

    public function chosenAndroidPlatform()
    {
        $android = WebDriverBy::cssSelector('option[value = "android"]');
        $this->clickOnElement($android);

        $inputToken = WebDriverBy::cssSelector('input[name = "token"]');
        $this->fillField($inputToken, $this->generateNumbers(10));
    }


    protected function generateName(string $name, int $length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvxwyz';
        $charactersLength = strlen($characters);
        $randomName = "";
        for ($i = 0; $i <= $length; $i++) {
            $randomName .= $characters[rand(0, $charactersLength
                - 1)];
        }
        return $name . "-" . $randomName;
    }

    protected function generateNumbers(int $length)
    {
        $numbers = "0123456789";
        $numbersLength = strlen($numbers);
        $serial = "";
        for ($i = 0; $i < $length; $i++) {
            $serial .= $numbers[rand(0, $numbersLength - 1)];
        }

        return $serial;
    }

}
