<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order;

use Doctrine\Common\Collections\Collection;

/**
 * 订单项集合，描述一组订单项，通常用于订单或购物车等场景.
 *
 * @author siganushka <siganushka@gmail.com>
 */
interface OrderItemCollectionInterface
{
    public function getItemsTotal(): int;

    public function getItems(): Collection;
}
