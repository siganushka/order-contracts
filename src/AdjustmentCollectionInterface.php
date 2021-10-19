<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order;

use Doctrine\Common\Collections\Collection;

/**
 * 调整对象集合，用于调整 OrderItemCollectionInterface 中的总计，比如 减优惠、加运费等.
 *
 * @author siganushka <siganushka@gmail.com>
 */
interface AdjustmentCollectionInterface
{
    public function getAdjustmentsTotal(): int;

    public function getAdjustments(): Collection;
}
