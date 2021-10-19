<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests\Fixtures;

use Siganushka\Contracts\Order\OrderItemInterface;
use Siganushka\Contracts\Order\OrderItemTrait;

class OrderItem implements OrderItemInterface
{
    use OrderItemTrait;
}
