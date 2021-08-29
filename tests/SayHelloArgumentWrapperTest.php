<?php

use functions\Functions;
use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new Functions();
    }

    /**
     * @dataProvider negativeDataProvider
     */
    public function testNegativeArray($input)
    {
        $this->expectException(InvalidArgumentException::class);

        $this->functions->sayHelloArgumentWrapper($input);
    }

    public function negativeDataProvider(): array
    {
        return [
            'error array' => [[]],
            'error null' => [null]
        ];
    }
}