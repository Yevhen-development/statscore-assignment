<?php

declare(strict_types=1);

namespace App;

enum ItemName: string
{
    case AGED_BRIE = 'Aged Brie';

    case BACK_STAGE = 'Backstage passes to a TAFKAL80ETC concert';

    case SULFURAS = 'Sulfuras, Hand of Ragnaros';
    
    case ELIXIR = 'Elixir of the Mongoose';
}