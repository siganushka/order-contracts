<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests\Fixtures;

use Siganushka\Contracts\Order\VariantInterface;
use Siganushka\Contracts\Order\VariantTrait;

class Variant implements VariantInterface
{
    use VariantTrait;
}
