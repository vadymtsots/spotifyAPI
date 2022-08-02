<?php

namespace App\Processor;

use JsonMapper;

class ArtistProcessor extends BaseProcessor
{
    public function __construct(protected JsonMapper $mapper)
    {
        $this->mapper->bEnforceMapType = false;
    }

    protected function process(object $entities): array
    {
        return [
            'spotify_id' => $entities->id,
            'name' => $entities->name,
            'followers' => $entities->followers->total,
            'popularity' => $entities->popularity,
            'genres' => $entities->genres,
            'url' => $entities->external_urls->spotify
        ];
    }
}
