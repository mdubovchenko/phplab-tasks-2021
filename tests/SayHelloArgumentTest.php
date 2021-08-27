<?php

use functions\Functions;
use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new Functions();
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, $this->functions->sayHelloArgument($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            'string' => ['world', 'Hello world'],
            'number' => [101, 'Hello 101'],
            'bool' => [true, 'Hello 1'],
        ];
    }
}