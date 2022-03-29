<?php

namespace App\Processor;

use App\Mappers\Album\Album;
use Illuminate\Support\Facades\Date;
use JetBrains\PhpStorm\ArrayShape;

class AlbumProcessor extends BaseProcessor
{
    /**
     * @param Album $entities
     * @return array
     */
    #[ArrayShape(['spotify_id' => "string", 'name' => "string", 'label' => "string", 'release_date' => "string", 'tracks' => "object"])]
    protected function process($entities): array
    {
        return [
            'spotify_id' => $entities->id,
            'name' => $entities->name,
            'label' => $entities->label,
            'release_date' => Date::createFromTimestamp(strtotime($entities->release_date))->format('j F Y'),
            'tracks' => $entities->tracks
        ];
    }

//    private function tracks(array $tracks)
//    {
//        $result = [];
//
//        foreach ($tracks as $track) {
//            $result[] = [
//                'track_number' => $track['track_number'],
//                'name' => $track['name'],
//                'duration' => Date::createFromTimestampMs($track['duration_ms'])->toTimeString(),
//            ];
//        }
//
//        return $result;
//    }
}
