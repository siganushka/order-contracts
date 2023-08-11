<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests;

use PHPUnit\Framework\TestCase;
use Siganushka\Contracts\Order\OrderItemInterface;
use Siganushka\Contracts\Order\Tests\Fixtures\OrderItem;
use Siganushka\Contracts\Order\Tests\Fixtures\Variant;

final class OrderItemTest extends TestCase
{
    /**
     * @dataProvider validOrderItemProvider
     */
    public function testAll(int $price, int $quantity, int $subtotal): void
    {
        $item = new OrderItem();
        static::assertInstanceOf(OrderItemInterface::class, $item);
        static::assertNull($item->getVariant());
        static::assertNull($item->getUnitPrice());
        static::assertNull($item->getQuantity());

        $variant = new Variant();
        $variant->setPrice($price);

        $item->setVariant($variant);
        $item->setQuantity($quantity);

        static::assertSame($variant, $item->getVariant());
        static::assertSame($price, $item->getUnitPrice());
        static::assertSame($quantity, $item->getQuantity());
        static::assertSame($subtotal, $item->getSubtotal());
    }

    public function testMethods(): void
    {
        static::assertSame([
            'getVariant',
            'setVariant',
            'getUnitPrice',
            'setUnitPrice',
            'getQuantity',
            'setQuantity',
            'getSubtotal',
        ], get_class_methods(new OrderItem()));
    }

    public function testUnitPriceSettingException(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('The unitPrice cannot be modified anymore.');

        $item = new OrderItem();
        $item->setUnitPrice(1);
    }

    public function testQuantityLessThanOrEqualZeroException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The quantity cannot be less than or equal to zero.');

        $item = new OrderItem();
        $item->setQuantity(-1);
    }

    public function testSubtotalWithEmptyUnitPriceException(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('The unitPrice cannot be empty.');

        $item = new OrderItem();
        $item->getSubtotal();
    }

    public function testSubtotalWithEmptyQuantityException(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('The quantity cannot be empty.');

        $variant = new Variant();
        $variant->setPrice(1);

        $item = new OrderItem();
        $item->setVariant($variant);
        $item->getSubtotal();
    }

    /**
     * @return array<int, array<?int>>
     */
    public function validOrderItemProvider(): array
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
