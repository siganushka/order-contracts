<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests;

use PHPUnit\Framework\TestCase;
use Siganushka\Contracts\Order\Tests\Fixtures\OrderItem;
use Siganushka\Contracts\Order\Tests\Fixtures\Variant;

/**
 * @internal
 * @coversNothing
 */
final class OrderItemTraitTest extends TestCase
{
    /**
     * @dataProvider validItemProvider
     *
     * @param mixed $price
     * @param mixed $quantity
     * @param mixed $subtotal
     */
    public function testAll($price, $quantity, $subtotal): void
    {
        $variant = new Variant();
        $variant->setPrice($price);

        $item = new OrderItem();
        static::assertNull($item->getVariant());
        static::assertNull($item->getUnitPrice());
        static::assertNull($item->getQuantity());
        static::assertSame(0, $item->getSubtotal());

        $item->setVariant($variant);
        $item->setQuantity($quantity);

        static::assertSame($variant, $item->getVariant());
        static::assertSame($price, $item->getUnitPrice());
        static::assertSame($quantity, $item->getQuantity());
        static::assertSame($subtotal, $item->getSubtotal());
    }

    public function testQuantityLessThanOrEqualZeroException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The quantity cannot be less than or equal to zero.');

        $item = new OrderItem();
        $item->setQuantity(-1);
    }

    public function validItemProvider()
    {
        return [
            [0, 3, 0],
            [10, 1, 10],
            [20, 10, 200],
            [50, 9, 450],
            [100, 12, 1200],
        ];
    }
}
