<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order;

/**
 * 订单项接口，描述了指定商品和其附加信息，并冗余了价格信息，防止 VariantInterface 发生变化.
 */
interface OrderItemInterface
{
    public function getVariant(): ?VariantInterface;

    public function setVariant(?VariantInterface $variant): self;

    public function getUnitPrice(): ?int;

    /**
     * @throws \BadMethodCallException The unitPrice cannot be modified anymore
     */
    public function setUnitPrice(?int $unitPrice): self;

    public function getQuantity(): ?int;

    /**
     * @throws \InvalidArgumentException The quantity cannot be less than or equal to zero
     */
    public function setQuantity(?int $quantity): self;

    /**
     * @throws \LogicException The unitPrice or quantity cannot be empty
     */
    public function getSubtotal(): int;
}
