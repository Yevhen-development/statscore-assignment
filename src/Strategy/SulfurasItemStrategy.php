<?php

declare(strict_types=1);

namespace App\Strategy;

use App\Item;

class SulfurasItemStrategy implements QualityUpdateStrategy
{
    public function updateQuality(Item $item): Item
    {
        return $item;
    }
}