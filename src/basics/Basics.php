<?php

namespace basics;

class Basics implements BasicsInterface
{
    /** @var BasicValidator */
    public  $validator;

    public function __construct()
    {
        $this->validator = new BasicsValidator();
    }

    /**
     * The $minute variable contains a number from 0 to 59 (i.e. 10 or 25 or 60 etc).
     * The method determines in which quarter of an hour the number falls.
     * It returns one of the values: "first", "second", "third" and "fourth".
     * It throws InvalidArgumentException if $minute is negative of greater then 60.
     *
     * @param int $minute
     * @return string
     */
    public function getMinuteQuarter(int $minute): string
    {
        if ($minute < 0 || $minute >= 60) {
            $this->validator->isMinutesException($minute);
            return "mistake";
        }

        if ($minute > 0 && $minute <= 15) {
            return "first";
        }

        if ($minute > 15 && $minute <= 30) {
            return "second";
        }

        if ($minute > 30 && $minute <= 45) {
            return "third";
        }

        return "fourth";
    }

    /**
     * The $year variable contains a year (i.e. 1995 or 2020 etc).
     * The method returns true if the year is Leap or false otherwise.
     * It throws InvalidArgumentException if $year is lower then 1900.
     *
     * @param int $year
     * @return boolean
     */
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

    /**
     * The method returns true if the sum of the first three digits is equal with the sum of last three ones
     * (i.e. in first case 1+2+3 not equal with 4+5+6 - it returns false).
     * It throws InvalidArgumentException if $input contains more then 6 digits.
     *
     * @param string $input
     * @return boolean
     */
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