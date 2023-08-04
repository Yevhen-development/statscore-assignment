<?php

declare(strict_types=1);

namespace App;

use App\Exception\QualityException;

final class Item
{
    function __construct(public readonly string $name, private int $sellIn, private int $quality)
    {
        if ($this->quality < 0) {
            throw new QualityException('The Quality of an item is never negative');
        }

        if ($this->quality > 50 && $this->name !== ItemName::SULFURAS->value) {
            throw new QualityException('The Quality of an item is never more than 50');
        }
    }

    /**
     * @return int
     */
    public function getSellIn(): int
    {
        return $this->sellIn;
    }

    /**
     * @param int $sellIn
     */
    public function setSellIn(int $sellIn): void
    {
        $this->sellIn = $sellIn;
    }

    /**
     * @return int
     */
    public function getQuality(): int
    {
        return $this->quality;
    }

    /**
     * @param int $quality
     */
    public function setQuality(int $quality): void
    {
        $this->quality = $quality;
    }

    public function __toString()
    {
        return "{$this->name}, {$this->sellIn}, {$this->quality}";
    }
}