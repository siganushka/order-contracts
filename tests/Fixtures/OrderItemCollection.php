<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests\Fixtures;

use Siganushka\Contracts\Order\OrderItemCollectionInterface;
use Siganushka\Contracts\Order\OrderItemCollectionTrait;

class OrderItemCollection implements OrderItemCollectionInterface
{
    use OrderItemCollectionTrait;
}
