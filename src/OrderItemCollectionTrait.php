<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait OrderItemCollectionTrait
{
    private int $itemsTotal = 0;

    /**
     * @var Collection<int, OrderItemInterface>
     */
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getItemsTotal(): int
    {
        return $this->itemsTotal;
    }

    /**
     * @return Collection<int, OrderItemInterface>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(OrderItemInterface $item): OrderItemCollectionInterface
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $this->recalculateItemsTotal();
        }

        return $this;
    }

    public function removeItem(OrderItemInterface $item): OrderItemCollectionInterface
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            $this->recalculateItemsTotal();
        }

        return $this;
    }

    public function clearItems(): OrderItemCollectionInterface
    {
        $this->items->clear();
        $this->recalculateItemsTotal();

        return $this;
    }

    public function countItems(): int
    {
        return $this->items->count();
    }

    protected function recalculateItemsTotal(): OrderItemCollectionInterface
    {
        $this->itemsTotal = array_reduce($this->items->toArray(), fn (int $carry, OrderItemInterface $item) => $carry + $item->getSubtotal(), 0);

        return $this;
    }
}
