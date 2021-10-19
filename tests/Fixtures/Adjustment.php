<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests\Fixtures;

use Siganushka\Contracts\Order\AdjustmentInterface;
use Siganushka\Contracts\Order\AdjustmentTrait;

class Adjustment implements AdjustmentInterface
{
    use AdjustmentTrait;
}
