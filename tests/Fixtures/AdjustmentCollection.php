<?php

declare(strict_types=1);

namespace Siganushka\Contracts\Order\Tests\Fixtures;

use Doctrine\Common\Collections\ArrayCollection;
use Siganushka\Contracts\Order\AdjustmentCollectionInterface;
use Siganushka\Contracts\Order\AdjustmentCollectionTrait;

class AdjustmentCollection implements AdjustmentCollectionInterface
{
    use AdjustmentCollectionTrait;

    public function __construct()
    {
        $this->adjustments = new ArrayCollection();
    }
}
