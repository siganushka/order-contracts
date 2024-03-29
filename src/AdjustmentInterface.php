<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order;

/**
 * 调整对象，用于表达可调整的金额，可以为负数.
 */
interface AdjustmentInterface
{
    public function getAmount(): ?int;

    public function setAmount(?int $amount): self;
}
