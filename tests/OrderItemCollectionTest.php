<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests;

use PHPUnit\Framework\TestCase;
use Siganushka\Contracts\Order\OrderItemCollectionInterface;
use Siganushka\Contracts\Order\Tests\Fixtures\OrderItem;
use Siganushka\Contracts\Order\Tests\Fixtures\OrderItemCollection;
use Siganushka\Contracts\Order\Tests\Fixtures\Variant;

final class OrderItemCollectionTest extends TestCase
{
    /**
     * @dataProvider orderItemCollectionProvider
     */
    public function testAll(): void
    {
        $collection = new OrderItemCollection();
        static::assertInstanceOf(OrderItemCollectionInterface::class, $collection);
        static::assertSame(0, $collection->getItemsTotal());
        static::assertSame(0, $collection->countItems());

        $arguments = \func_get_args();
        $itemsTotal = array_pop($arguments);

        foreach ($arguments as $price) {
            $variant = new Variant();
            $variant->setPrice($price);

            $item = new OrderItem();
            $item->setVariant($variant);
            $item->setQuantity(1);

            $collection->addItem($item);
        }

        static::assertSame($itemsTotal, $collection->getItemsTotal());
        static::assertSame(\count($arguments), $collection->countItems());

        $collection->clearItems();
        static::assertSame(0, $collection->getItemsTotal());
        static::assertSame(0, $collection->countItems());
    }

    public function testMethods(): void
    {
        static::assertSame([
            '__construct',
            'getItemsTotal',
            'getItems',
            'addItem',
            'removeItem',
            'clearItems',
            'countItems',
        ], get_class_methods(new OrderItemCollection()));
    }

    /**
     * @return array<int, array<int>>
     */
    public function orderItemCollectionProvider(): array
    {
        return [
            [0, 3, 3],
            [7, 0, 7],
            [10, 1, 11],
            [20, 5, 25],
            [50, 100, 350, 0, 500],
            [100, 1, 12, 113],
        ];
    }
}
