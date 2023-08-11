<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests;

use PHPUnit\Framework\TestCase;
use Siganushka\Contracts\Order\AdjustmentCollectionInterface;
use Siganushka\Contracts\Order\Tests\Fixtures\Adjustment;
use Siganushka\Contracts\Order\Tests\Fixtures\AdjustmentCollection;

final class AdjustmentCollectionTest extends TestCase
{
    /**
     * @dataProvider validAdjustmentProvider
     */
    public function testAll(int $amount): void
    {
        $collection = new AdjustmentCollection();
        static::assertInstanceOf(AdjustmentCollectionInterface::class, $collection);
        static::assertSame(0, $collection->getAdjustmentsTotal());
        static::assertSame(0, $collection->countAdjustments());

        $arguments = \func_get_args();
        $adjustmentsTotal = array_pop($arguments);

        foreach ($arguments as $amount) {
            $adjustment = new Adjustment();
            $adjustment->setAmount($amount);
            $collection->addAdjustment($adjustment);
        }

        static::assertSame($adjustmentsTotal, $collection->getAdjustmentsTotal());
        static::assertSame(\count($arguments), $collection->countAdjustments());

        $collection->clearAdjustments();
        static::assertSame(0, $collection->getAdjustmentsTotal());
        static::assertSame(0, $collection->countAdjustments());
    }

    public function testMethods(): void
    {
        static::assertSame([
            '__construct',
            'getAdjustmentsTotal',
            'getAdjustments',
            'addAdjustment',
            'removeAdjustment',
            'clearAdjustments',
            'countAdjustments',
        ], get_class_methods(new AdjustmentCollection()));
    }

    /**
     * @return array<int, array<int>>
     */
    public function validAdjustmentProvider(): array
    {
        return [
            [-10, 5, 5, -30, -30],
            [3, 3],
            [10, 2, 20, 32],
            [20, 10, 200, 230],
            [50, 9, 450, 509],
            [100, 12, 300, -10, 3, 405],
        ];
    }
}
