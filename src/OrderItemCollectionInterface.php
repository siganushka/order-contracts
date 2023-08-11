<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order;

use Doctrine\Common\Collections\Collection;

/**
 * 订单项集合，描述一组订单项，通常用于订单或购物车等场景.
 */
interface OrderItemCollectionInterface
{
    public function getItemsTotal(): int;

    /**
     * @return Collection<int, OrderItemInterface>
     */
    public function getItems(): Collection;

    public function addItem(OrderItemInterface $item): self;

    public function removeItem(OrderItemInterface $item): self;

    public function clearItems(): self;

    public function countItems(): int;
}
