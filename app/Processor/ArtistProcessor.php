<?php

namespace App\Processor;

use App\Mappers\Artist\Artist;
use JetBrains\PhpStorm\ArrayShape;
use JsonMapper;

class ArtistProcessor extends BaseProcessor
{
    public function __construct(protected JsonMapper $mapper)
    {
        $this->mapper->bEnforceMapType = false;
    }

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
