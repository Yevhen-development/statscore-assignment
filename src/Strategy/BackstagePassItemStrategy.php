<?php

declare(strict_types=1);

namespace App\Strategy;

use App\Item;

class BackstagePassItemStrategy implements QualityUpdateStrategy
{
    public function updateQuality(Item $item): Item
    {
        if ($item->getQuality() < 50) {
            $item->setQuality($item->getQuality() + 1);
            if ($item->getSellIn() < 11 && $item->getQuality() < 50) {
                $item->setQuality($item->getQuality() + 1);
            }
            if ($item->getSellIn() < 6 && $item->getQuality() < 50) {
                $item->setQuality($item->getQuality() + 1);
            }
        }

        $item->setSellIn($item->getSellIn() - 1);

        if ($item->getSellIn() < 0) {
            $item->setQuality(0);
        }

        return $item;
    }
}