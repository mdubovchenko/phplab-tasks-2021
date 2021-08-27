<?php

use functions\Functions;
use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new Functions();
    }

    /**
     * @dataProvider negativeDataProvider
     */
    public function testNegativeArray(...$input)
    {
        $this->expectException(InvalidArgumentException::class);

        $this->functions->countArgumentsWrapper(...$input);
    }

    public function negativeDataProvider(): array
    {
        return [
            'error number' => ['a', 'b', 1],
            'error bool' => [false, 'a']
        ];
    }
}