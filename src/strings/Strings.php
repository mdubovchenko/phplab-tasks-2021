<?php

namespace strings;

class Strings implements StringsInterface
{
    /**
     * The $input variable contains text in snake case (i.e. hello_world or this_is_home_task)
     * The method transforms it into camel cased string and returns (i.e. helloWorld or thisIsHomeTask)
     *
     * @param string $input
     * @return string
     */
    public function snakeCaseToCamelCase(string $input): string
    {
        $str = ucwords(
            str_replace('_', ' ', $input)
        );

        return lcfirst(
            str_replace(' ', '', $str)
        );
    }

    /**
     * The $input variable contains multibyte text like 'ФЫВА олдж'
     * The method mirrors each word individually and return transformed text (i.e. 'АВЫФ ждло')
     *
     * @param string $input
     * @return string
     */
    public function mirrorMultibyteString(string $input): string
    {
        $str = '';
        for ($i = mb_strlen($input); $i >= 0; $i--) {
            $str .= mb_substr($input, $i, 1);
        }
        $arr = explode(' ', $str);
        $arrRev = array_reverse($arr);

        return implode(' ', $arrRev);
    }

    /**
     * The method uses the formula: 'The' + a noun with first letter capitalized.
     * However, when a noun STARTS and ENDS with the same letter,
     * it repeats the noun twice and connects them together with the first and last letter,
     * combined into one word
     *
     * @param string $noun
     * @return string
     */
    public function getBrandName(string $noun): string
    {
        $firstLetter = substr($noun, 0, 1);
        $lastLetter = substr($noun, -1);

        if ($firstLetter !== $lastLetter) {
            return ucwords("The {$noun}");
        }

        return ucwords(
            substr_replace($noun, $noun, -1)
        );
    }
}