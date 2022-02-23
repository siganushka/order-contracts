<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests\Fixtures;

use Siganushka\Contracts\Order\AdjustmentCollectionInterface;
use Siganushka\Contracts\Order\AdjustmentCollectionTrait;

class AdjustmentCollection implements AdjustmentCollectionInterface
{
    use AdjustmentCollectionTrait;
}
