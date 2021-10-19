<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order;

/**
 * 订单项，描述了指定商品和其附加信息，并冗余了价格等信息，防止 VariantInterface 发生变化.
 *
 * @author siganushka <siganushka@gmail.com>
 */
interface OrderItemInterface
{
    public function getVariant(): ?VariantInterface;

    public function getUnitPrice(): ?int;

    public function getQuantity(): ?int;

    public function getSubtotal(): int;
}
