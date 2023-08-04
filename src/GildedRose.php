<?php

declare(strict_types=1);

namespace App;

use App\Strategy\AgedBrieItemStrategy;
use App\Strategy\BackstagePassItemStrategy;
use App\Strategy\DefaultItemStrategy;
use App\Strategy\QualityUpdateStrategy;
use App\Strategy\SulfurasItemStrategy;

final class GildedRose
{
    public function updateQuality(Item $item): void
    {
        $strategy = $this->getQualityUpdateStrategy($item);
        $strategy->updateQuality($item);
    }

    private function getQualityUpdateStrategy(Item $item): QualityUpdateStrategy
    {
        return match ($item->name) {
            ItemName::AGED_BRIE->value => new AgedBrieItemStrategy(),
            ItemName::BACK_STAGE->value => new BackstagePassItemStrategy(),
            ItemName::SULFURAS->value => new SulfurasItemStrategy(),
            default => new DefaultItemStrategy(),
        };
    }
}
