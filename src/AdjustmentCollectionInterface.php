<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order;

use Doctrine\Common\Collections\Collection;

/**
 * 调整对象集合，用于调整 OrderItemCollectionInterface 中的总计，比如 减优惠、加运费等.
 */
interface AdjustmentCollectionInterface
{
    public function getAdjustmentsTotal(): int;

    /**
     * @return Collection<int, AdjustmentInterface>
     */
    public function getAdjustments(): Collection;

    public function addAdjustment(AdjustmentInterface $adjustment): self;

    public function removeAdjustment(AdjustmentInterface $adjustment): self;

    public function clearAdjustments(): self;

    public function countAdjustments(): int;
}
