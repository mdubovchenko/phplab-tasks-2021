<?php

require_once 'src/web/functions.php';

use PHPUnit\Framework\TestCase;

class GetUniqueFirstLettersTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, getUniqueFirstLetters($input));
    }

    /**
     * @dataProvider negativeDataProvider
     */
    public function testNegative($input)
    {
        $this->expectException(InvalidArgumentException::class);

        getUniqueFirstLetters($input);
    }

    public function positiveDataProvider(): array
    {
        return [
            [[["name" => "Albuquerque"]], ["A"]],
            [[["name" => "Detroit"]], ["D"]],
            [[["name" => "Kansas"]], ["K"]],
            [[["name" => "Orlando"], ["name" => "Chicago"]], ["C", "O"]],
            [[["name" => "Memphis"], ["name" => "Manchester"]], ["M"]],
            [[["name" => "Portland"], ["name" => "Ohare"], ["name" => "Ontario"]], ["O", "P"]],
        ];
    }

    public function negativeDataProvider(): array
    {
        return [
            'error num' => [['name' => 1]],
            'error bool' => [['name' => true]],
            'error array' => [['name' => ['a', 'b']]]
        ];
    }
}