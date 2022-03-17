<?php

namespace App\Processor;

use JetBrains\PhpStorm\ArrayShape;
use stdClass;

class ArtistProcessor
{
    public function get(array $artists): array
    {
        return $this->process($artists);
    }

    #[ArrayShape(['spotify_id' => "mixed", 'name' => "mixed", 'followers' => "mixed", 'genres' => "array"])]
    private function process(array $artists): array
    {
        $result = [];
        foreach ($artists['artists']['items'] as $artist) {
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
