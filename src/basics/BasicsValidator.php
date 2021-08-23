<?php

namespace basics;

use InvalidArgumentException;

class BasicsValidator implements BasicsValidatorInterface
{
    public function isMinutesException(int $minute): void
    {
        throw new InvalidArgumentException('The variable must be > 0 and < 60. Input was: ' . $minute);
    }

    public function isYearException(int $year): void
    {
        throw new InvalidArgumentException('The variable must be > 1900. Input was: ' . $year);
    }

    public function isValidStringException(string $input): void
    {
        throw new InvalidArgumentException('the variable contains more then 6 digits. Input was: ' . $input);
    }
}