<?php

declare(strict_types=1);

namespace App\Strategy;

use App\Item;

interface QualityUpdateStrategy
{
    public function updateQuality(Item $item): Item;
}