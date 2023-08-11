<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests;

use PHPUnit\Framework\TestCase;
use Siganushka\Contracts\Order\AdjustmentInterface;
use Siganushka\Contracts\Order\Tests\Fixtures\Adjustment;

final class AdjustmentTest extends TestCase
{
    /**
     * @dataProvider validAmountProvider
     */
    public function testAll(?int $amount): void
    {
        $adjustment = new Adjustment();
        static::assertInstanceOf(AdjustmentInterface::class, $adjustment);
        static::assertNull($adjustment->getAmount());

        $adjustment->setAmount($amount);
        static::assertSame($amount, $adjustment->getAmount());
    }

    public function testMethods(): void
    {
        static::assertSame([
            'getAmount',
            'setAmount',
        ], get_class_methods(new Adjustment()));
    }

    public function testAmountZeroException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The amount cannot be zero.');

        $adjustment = new Adjustment();
        $adjustment->setAmount(0);
    }

    /**
     * @return array<int, array<?int>>
     */
    public function validAmountProvider(): array
    {
        return [
            [-1],
            [-1024],
            [16],
            [65535],
            [\PHP_INT_MAX],
        ];
    }
}
