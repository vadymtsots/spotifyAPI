<?php

namespace App\Processor;

use App\Helpers\DateTimeHelper;
use App\Mappers\Album\TracksItems;
use JsonMapper;

class AlbumProcessor extends BaseProcessor
{
    public function __construct(protected JsonMapper $mapper)
    {
        $this->mapper->bEnforceMapType = false;
    }

    protected function process($entities): array
    {
        $albumDuration = $this->calculateAlbumDuration($entities->tracks->items);
        $tracklist = $this->getTracklist($entities->tracks->items);

        return [
            'spotify_id' => $entities->id,
            'name' => $entities->name,
            'label' => $entities->label,
            'release_date' => DateTimeHelper::getReleaseDateString($entities->release_date),
            'duration' => $albumDuration,
            'tracklist' => $tracklist
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
        $tracksDurations = $this->extractTracksDurations($tracks);
        $albumDuration = array_sum($tracksDurations);

        return DateTimeHelper::getTimeString($albumDuration);
    }

    private function getTracklist(array $tracks): array
    {
        $tracklist = [];

        /**
         * @var TracksItems $track
         */
        foreach($tracks as $track) {
            $tracklist[] =
                [
                    'id' => $track->id,
                    'number' => $track->track_number,
                    'name' => $track->name,
                    'duration' => DateTimeHelper::getTimeString($track->duration_ms)
                ];
        }

        return $tracklist;
    }
}
