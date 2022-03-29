<?php

namespace App\Processor;

use App\Mappers\Artist\Artist;
use JetBrains\PhpStorm\ArrayShape;

class ArtistProcessor extends BaseProcessor
{
    /**
     * @param Artist $entities
     * @return array
     */
    #[ArrayShape(['name' => "string", 'followers' => "string", 'popularity' => "int", 'genres' => "array", 'url' => 'string'])]
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
