<?php

namespace App\Processor;

class SearchProcessor extends BaseProcessor
{
    /**
     * @param object $entities
     * @return array
     */
    protected function process(object $entities): array
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
