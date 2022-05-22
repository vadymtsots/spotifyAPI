<?php

namespace App\Processor;

use App\Mappers\Artist\Artist;
use JetBrains\PhpStorm\ArrayShape;

class ArtistProcessor extends BaseProcessor
{
    protected function process($entities): array
    {
        return [
            'name' => $entities->name,
            'followers' => number_format($entities->followers->total),
            'popularity' => $entities->popularity,
            'genres' => $entities->genres,
            'url' => $entities->external_urls->spotify
        ];
    }
}
