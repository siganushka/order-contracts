<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests;

use PHPUnit\Framework\TestCase;
use Siganushka\Contracts\Order\Tests\Fixtures\Variant;
use Siganushka\Contracts\Order\VariantInterface;

final class VariantTest extends TestCase
{
    /**
     * @dataProvider validPriceProvider
     */
    public function testAll(?int $price): void
    {
        $variant = new Variant();
        static::assertInstanceOf(VariantInterface::class, $variant);
        static::assertNull($variant->getPrice());

        $variant->setPrice($price);
        static::assertSame($price, $variant->getPrice());
    }

    public function testMethods(): void
    {
        static::assertSame([
            'getPrice',
            'setPrice',
        ], get_class_methods(new Variant()));
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
            [12],
            [null],
            [0],
            [16],
            [65535],
            [\PHP_INT_MAX],
        ];
    }
}
