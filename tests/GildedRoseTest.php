<?php

use App\Exception\QualityException;
use App\GildedRose;
use App\Item;
use App\ItemName;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    /**
     * @dataProvider itemsProvider
     * @param string $name
     * @param int $sellIn
     * @param int $quality
     * @param int $expectedSellIn
     * @param int $expectedQuality
     */
    public function testUpdateQualityTest(string $name, int $sellIn, int $quality, int $expectedSellIn, int $expectedQuality): void
    {
        $item = new Item($name, $sellIn, $quality);

        $gildedRose = new GildedRose();
        $gildedRose->updateQuality($item);

        $this->assertEquals($expectedSellIn, $item->sellIn);
        $this->assertEquals($expectedQuality, $item->quality);
    }

    public function testCannotHaveNegativeQuality()
    {
        $this->expectException(QualityException::class);
        $this->expectExceptionMessage('The Quality of an item is never negative');
        new Item(ItemName::AGED_BRIE->value, 4, -6);
    }

    public function testQualityIsValid()
    {
        new Item(ItemName::SULFURAS->value, 4, 100);
        $this->expectException(QualityException::class);
        $this->expectExceptionMessage('The Quality of an item is never more than 50');
        new Item(ItemName::AGED_BRIE->value, 4, 100);
    }

    public function itemsProvider(): array
    {
        return [
            'Aged Brie before sell in date' => [ItemName::AGED_BRIE->value, 10, 10, 9, 11],
            'Aged Brie sell in date' => [ItemName::AGED_BRIE->value, 0, 10, -1, 12],
            'Aged Brie after sell in date' => [ItemName::AGED_BRIE->value, -5, 10, -6, 12],
            'Aged Brie before sell in date with maximum quality' => [ItemName::AGED_BRIE->value, 5, 50, 4, 50],
            'Aged Brie sell in date near maximum quality' => [ItemName::AGED_BRIE->value, 0, 49, -1, 50],
            'Aged Brie sell in date with maximum quality' => [ItemName::AGED_BRIE->value, 0, 50, -1, 50],
            'Aged Brie after_sell in date with maximum quality' => [ItemName::AGED_BRIE->value, -10, 50, -11, 50],
            'Backstage passes before sell in date' => [ItemName::BACK_STAGE->value, 10, 10, 9, 12],
            'Backstage passes more than 10 days before sell in date' => [ItemName::BACK_STAGE->value, 11, 10, 10, 11],
            'Backstage passes five days before sell in date' => [ItemName::BACK_STAGE->value, 5, 10, 4, 13],
            'Backstage passes sell in date' => [ItemName::BACK_STAGE->value, 0, 10, -1, 0],
            'Backstage passes close to sell in date with maximum quality' => [ItemName::BACK_STAGE->value, 10, 50, 9, 50],
            'Backstage passes very close to sell in date with maximum quality' => [ItemName::BACK_STAGE->value, 5, 50, 4, 50],
            'Backstage passes after sell in date' => [ItemName::BACK_STAGE->value, -5, 50, -6, 0],
            'Sulfuras before sell in date' => [ItemName::SULFURAS->value, 10, 80, 10, 80],
            'Sulfuras sell in date' => [ItemName::SULFURAS->value, 0, 80, 0, 80],
            'Sulfuras after sell in date' => [ItemName::SULFURAS->value, -1, 80, -1, 80],
            'Elixir of the Mongoose before sell in date' => [ItemName::ELIXIR->value, 10, 10, 9, 9],
            'Elixir of the Mongoose sell in date' => [ItemName::ELIXIR->value, 0, 10, -1, 8],
        ];
    }
}
