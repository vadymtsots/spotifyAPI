<?php

namespace App\Processor;

use App\Mappers\Album\Album;
use App\Mappers\Album\TracksItems;
use Illuminate\Support\Facades\Date;
use JetBrains\PhpStorm\ArrayShape;

class AlbumProcessor extends BaseProcessor
{
    /**
     * @param Album $entities
     * @return array
     */
    #[ArrayShape(['spotify_id' => "string", 'name' => "string", 'label' => "string", 'release_date' => "string", 'duration' => "string"])]
    protected function process($entities): array
    {
        $albumDuration = $this->calculateAlbumDuration($entities->tracks->items);
        return [
            'spotify_id' => $entities->id,
            'name' => $entities->name,
            'label' => $entities->label,
            'release_date' => Date::createFromTimestamp(strtotime($entities->release_date))->format('j F Y'),
            'duration' => $albumDuration
//            'tracks' => $entities->tracks
        ];
    }

    private function extractTracksDurations(array $tracks): array
    {
        $durations = [];
        /** @var TracksItems $track */
        foreach($tracks as $track) {
            $durations[] = $track->duration_ms;
        }

        return $durations;
    }

    private function calculateAlbumDuration(array $tracks): string
    {
        $durations = $this->extractTracksDurations($tracks);
        $total = array_sum($durations);
        return Date::createFromTimestampMs($total)->toTimeString();
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
