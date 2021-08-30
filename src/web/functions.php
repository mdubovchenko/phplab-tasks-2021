<?php
/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param  array  $airports
 * @return string[]
 */
function getUniqueFirstLetters(array $airports): array
{
    $uniqueFirstLetters = [];
    foreach ($airports as $airport) {
        if (!is_string($airport['name'])) {
            throw new InvalidArgumentException('The variable must be string');
        }
        $firstLetter = substr(trim($airport['name']), 0, 1);
        if (!in_array($firstLetter, $uniqueFirstLetters)) {
            $uniqueFirstLetters[] = $firstLetter;
        }
    }
    sort($uniqueFirstLetters);

    return $uniqueFirstLetters;
}