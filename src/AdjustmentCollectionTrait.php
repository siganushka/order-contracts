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

    protected function recalculateAdjustmentsTotal(): AdjustmentCollectionInterface
    {
        $amounts = $this->adjustments->map(function (AdjustmentInterface $adjustment) {
            return $adjustment->getAmount();
        });

        $this->adjustmentsTotal = (int) array_sum($amounts->toArray());

        return $this;
    }
}
