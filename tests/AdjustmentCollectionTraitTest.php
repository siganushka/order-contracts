<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests;

use PHPUnit\Framework\TestCase;
use Siganushka\Contracts\Order\Tests\Fixtures\Adjustment;
use Siganushka\Contracts\Order\Tests\Fixtures\AdjustmentCollection;

/**
 * @internal
 * @coversNothing
 */
final class AdjustmentCollectionTraitTest extends TestCase
{
    /**
     * @dataProvider getMockAdjustments
     */
    public function testAll(): void
    {
        $collection = new AdjustmentCollection();
        static::assertSame(0, $collection->getAdjustmentsTotal());
        static::assertCount(0, $collection->getAdjustments());

        $arguments = \func_get_args();
        $adjustmentsTotal = array_pop($arguments);

        foreach ($arguments as $amount) {
            $adjustment = new Adjustment();
            $adjustment->setAmount($amount);
            $collection->addAdjustment($adjustment);
        }

        static::assertSame($adjustmentsTotal, $collection->getAdjustmentsTotal());
        static::assertCount(\count($arguments), $collection->getAdjustments());
    }

    public function getMockAdjustments()
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
