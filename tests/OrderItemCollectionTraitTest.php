<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests;

use PHPUnit\Framework\TestCase;
use Siganushka\Contracts\Order\Tests\Fixtures\OrderItem;
use Siganushka\Contracts\Order\Tests\Fixtures\OrderItemCollection;
use Siganushka\Contracts\Order\Tests\Fixtures\Variant;

/**
 * @internal
 * @coversNothing
 */
final class OrderItemCollectionTraitTest extends TestCase
{
    /**
     * @dataProvider getMockItems
     */
    public function testAll(): void
    {
        $collection = new OrderItemCollection();
        static::assertSame(0, $collection->getItemsTotal());
        static::assertCount(0, $collection->getItems());

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
        static::assertCount(\count($arguments), $collection->getItems());
    }

    public function getMockItems()
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
