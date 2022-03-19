<?php

namespace App\Processor;

use JetBrains\PhpStorm\ArrayShape;
use stdClass;

class ArtistProcessor extends BaseProcessor
{
    /**
     * @param array $entities
     * @return array
     */
    protected function process(array $entities): array
    {
        $result = [];
        foreach ($entities['artists']['items'] as $artist) {
            $result[] = [
                'spotify_id' => $artist['id'],
                'name' => $artist['name'],
                'followers' => $artist['followers']['total'],
                'genres' => $artist['genres']
            ];
        }
        return $result;
    }
}
