<?php

use functions\Functions;
use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new Functions();
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($expected, ...$input)
    {
        $this->assertEquals($expected, $this->functions->countArguments(...$input));
    }

    public function positiveDataProvider(): array
    {
        return [
            'without arguments' => [
                [
                    'argument_count' => 0,
                    'argument_values' => [],
                ],
            ],
            'one argument' => [
                [
                    'argument_count' => 1,
                    'argument_values' => ['string',],
                ],
                'string',
            ],
            'two arguments' => [
                [
                    'argument_count' => 2,
                    'argument_values' => ['hello', 'world',],
                ],
                'hello',
                'world',
            ],
        ];
    }
}