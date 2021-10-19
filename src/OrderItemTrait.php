<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order;

trait OrderItemTrait
{
    private $variant;
    private $unitPrice;
    private $quantity;

    public function getVariant(): ?VariantInterface
    {
        return $this->variant;
    }

    public function setVariant(?VariantInterface $variant): OrderItemInterface
    {
        $this->variant = $variant;

        if ($this->variant) {
            $this->unitPrice = $variant->getPrice();
        }

        return $this;
    }

    public function getUnitPrice(): ?int
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(?int $unitPrice): void
    {
        throw new \BadMethodCallException('The unitPrice cannot be modified anymore.');
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): OrderItemInterface
    {
        if (null !== $quantity && $quantity <= 0) {
            throw new \InvalidArgumentException('The quantity cannot be less than or equal to zero.');
        }

        $this->quantity = $quantity;

        return $this;
    }

    public function getSubtotal(): int
    {
        return $this->unitPrice * $this->quantity;
    }
}
