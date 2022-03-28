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
    #[ArrayShape(['name' => "mixed", 'followers' => "string", 'genres' => "mixed"])]
    protected function process($entities): array
    {
        return [
            'name' => $entities->name,
            'followers' => number_format($entities->followers->total),
            'genres' => $entities->genres
        ];
    }
}
