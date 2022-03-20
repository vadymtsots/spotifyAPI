<?php

namespace App\Processor;

use Illuminate\Support\Facades\Date;

class AlbumProcessor extends BaseProcessor
{
    protected function process(array $entities)
    {
        $result = [];
        $album = $entities;

        $result = [
            'spotify_id' => $album['id'],
            'name' => $album['name'],
            'label' => $album['label'],
            'release_date' => Date::createFromTimestamp(strtotime($album['release_date']))->format('j F Y'),
            'tracks' => $this->tracks($album['tracks']['items'])
        ];

        return $result;
    }

    private function tracks(array $tracks)
    {
        $result = [];

        foreach ($tracks as $track) {
            $result[] = [
                'track_number' => $track['track_number'],
                'name' => $track['name'],
                'duration' => Date::createFromTimestampMs($track['duration_ms'])->toTimeString(),
            ];
        }

        return $result;
    }
}
