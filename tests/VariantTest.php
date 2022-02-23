<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests;

use PHPUnit\Framework\TestCase;
use Siganushka\Contracts\Order\Tests\Fixtures\Variant;

final class VariantTest extends TestCase
{
    /**
     * @dataProvider validPriceProvider
     *
     * @param ?int $price
     * @param ?int $intPrice
     */
    public function testAll($price, $intPrice): void
    {
        $variant = new Variant();
        static::assertNull($variant->getPrice());

        $variant->setPrice($price);
        static::assertSame($intPrice, $variant->getPrice());
    }

    public function testPriceLessThanZeroException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The price cannot be less than zero.');

        $variant = new Variant();
        $variant->setPrice(-10);
    }

    /**
     * @return array<int, array<?int>>
     */
    public function validPriceProvider(): array
    {
        return [
            [null, null],
            [0, 0],
            [16, 16],
            [65535, 65535],
            [\PHP_INT_MAX, \PHP_INT_MAX],
        ];
    }
}
