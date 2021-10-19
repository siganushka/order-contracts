<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order;

trait AdjustmentTrait
{
    private $amount;

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): AdjustmentInterface
    {
        if (0 === $amount) {
            throw new \InvalidArgumentException('The amount cannot be zero.');
        }

        $this->amount = $amount;

        return $this;
    }
}
