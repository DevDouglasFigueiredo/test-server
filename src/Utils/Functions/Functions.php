<?php

namespace src\Utils\Functions;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;

class Functions
{

    private WebDriver $driver;

    public function __construct(WebDriver $driver)
    {
        $this->driver = $driver;
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

    public function clickOnElement($elementToBeClicked)
    {
        $this->driver->findElement($elementToBeClicked)->click();
    }

    public function fillField($element, $value)
    {
        $this->driver->findElement($element)->sendKeys($value);
    }

}
