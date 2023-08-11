<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order;

trait OrderItemTrait
{
    private ?VariantInterface $variant = null;
    private ?int $unitPrice = null;
    private ?int $quantity = null;

    public function getVariant(): ?VariantInterface
    {
        return $this->variant;
    }

    public function setVariant(?VariantInterface $variant): OrderItemInterface
    {
        $this->variant = $variant;

        if ($variant instanceof VariantInterface) {
            $this->unitPrice = $variant->getPrice();
        }

        return $this;
    }

    public function getUnitPrice(): ?int
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(?int $unitPrice): OrderItemInterface
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
        if (null === $this->unitPrice) {
            throw new \LogicException('The unitPrice cannot be empty.');
        }

        if (null === $this->quantity) {
            throw new \LogicException('The quantity cannot be empty.');
        }

        return $this->unitPrice * $this->quantity;
    }
}
