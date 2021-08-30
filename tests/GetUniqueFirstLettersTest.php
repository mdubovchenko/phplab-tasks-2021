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

    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);

        getUniqueFirstLetters([['name' => 1]]);
    }

    public function positiveDataProvider(): array
    {
        return [
            [[["name" => "Albuquerque"]], ["A"]],
            [[["name" => "Detroit"]], ["D"]],
            [[["name" => "Kansas"]], ["K"]],
        ];
    }
}