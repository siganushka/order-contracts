<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order;

/**
 * 商品接口，任何实现了此接口的对象，都可以被售卖.
 */
interface VariantInterface
{
    public function getPrice(): ?int;

    public function setPrice(?int $price): self;
}
