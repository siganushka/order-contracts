<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests;

use PHPUnit\Framework\TestCase;
use Siganushka\Contracts\Order\Tests\Fixtures\Adjustment;

/**
 * @internal
 * @coversNothing
 */
final class AdjustmentTraitTest extends TestCase
{
    public function testAll(): void
    {
        $adjustment = new Adjustment();
        static::assertNull($adjustment->getAmount());

        $adjustment->setAmount(1024);
        static::assertSame(1024, $adjustment->getAmount());

        $adjustment->setAmount(null);
        static::assertNull($adjustment->getAmount());
    }

    public function testAmountZeroException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The amount cannot be zero.');

        $adjustment = new Adjustment();
        $adjustment->setAmount(0);
    }
}
