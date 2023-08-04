<?php

declare(strict_types=1);

namespace App\Strategy;

use App\Item;

class DefaultItemStrategy implements QualityUpdateStrategy
{
    public function updateQuality(Item $item): Item
    {
        if ($item->quality > 0) {
            $item->quality -= 1;
        }

        $item->sellIn -= 1;
        
        if ($item->sellIn < 0 && $item->quality > 0) {
            $item->quality -= 1;
        }

        return $item;
    }
}