<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests\Fixtures;

use Doctrine\Common\Collections\ArrayCollection;
use Siganushka\Contracts\Order\OrderItemCollectionInterface;
use Siganushka\Contracts\Order\OrderItemCollectionTrait;

class OrderItemCollection implements OrderItemCollectionInterface
{
    use OrderItemCollectionTrait;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }
}
