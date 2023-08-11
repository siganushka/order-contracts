<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait AdjustmentCollectionTrait
{
    private int $adjustmentsTotal = 0;

    /**
     * @var Collection<int, AdjustmentInterface>
     */
    private Collection $adjustments;

    public function __construct()
    {
        $this->adjustments = new ArrayCollection();
    }

    public function getAdjustmentsTotal(): int
    {
        return $this->adjustmentsTotal;
    }

    /**
     * @return Collection<int, AdjustmentInterface>
     */
    public function getAdjustments(): Collection
    {
        return $this->adjustments;
    }

    public function addAdjustment(AdjustmentInterface $adjustment): AdjustmentCollectionInterface
    {
        if (!$this->adjustments->contains($adjustment)) {
            $this->adjustments[] = $adjustment;
            $this->recalculateAdjustmentsTotal();
        }

        return $this;
    }

    public function removeAdjustment(AdjustmentInterface $adjustment): AdjustmentCollectionInterface
    {
        if ($this->adjustments->contains($adjustment)) {
            $this->adjustments->removeElement($adjustment);
            $this->recalculateAdjustmentsTotal();
        }

        return $this;
    }

    public function clearAdjustments(): AdjustmentCollectionInterface
    {
        $this->adjustments->clear();
        $this->recalculateAdjustmentsTotal();

        return $this;
    }

    public function countAdjustments(): int
    {
        return $this->adjustments->count();
    }

    protected function recalculateAdjustmentsTotal(): AdjustmentCollectionInterface
    {
        $this->adjustmentsTotal = array_reduce($this->adjustments->toArray(), fn (int $carry, AdjustmentInterface $adjustment) => $carry + (int) $adjustment->getAmount(), 0);

        return $this;
    }
}
