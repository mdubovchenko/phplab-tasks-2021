<?php

namespace basics;

class Basics implements BasicsInterface
{
    public $validator;

    public function __construct()
    {
        $this->validator = new BasicsValidator();
    }

    public function getMinuteQuarter(int $minute): string
    {
        if ($minute > 0 && $minute <= 15) {
            return "first";
        }

        if ($minute >15 && $minute <= 30) {
            return "second";
        }

        if ($minute >30 && $minute <=45) {
            return "third";
        }

        if (($minute >45 && $minute <60) || $minute == 0) {
            return "fourth";
        }

        $this->validator->isMinutesException($minute);
        return "mistake";
    }

    public function isLeapYear(int $year): bool
    {
       if ($year < 1900) {
           $this->validator->isYearException($year);
           return false;
       }
       if ($year % 400 == 0) {
           return true;
       }
       if ($year % 100 == 0) {
           return false;
       }
       if ($year % 4 == 0) {
           return true;
       }
       return false;
    }

    public function isSumEqual(string $input): bool
    {
        $i = strlen($input);
        $sumFirst = 0;
        $sumSecond = 0;

        if ($i < 6) {
            $this->validator->isYearException($input);
            return false;
        }

        for ($k = 0; $k < ($i/2); $k++) {
            $sumFirst = $sumFirst + (int)$input[$k];
        }

        for ($k = ($i/2); $k < $i; $k++) {
            $sumSecond = $sumSecond + (int)$input[$k];
        }

        if ($sumFirst == $sumSecond) {
            return true;
        }

        return false;
    }
}