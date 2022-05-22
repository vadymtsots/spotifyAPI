<?php

namespace App\Processor;

use App\Helpers\DateTimeHelper;
use App\Mappers\ArtistAlbums\AlbumItems;
use Exception;
use Illuminate\Support\Facades\Log;

class ArtistAlbumsProcessor extends BaseProcessor
{
    protected function process(object $entities): array
    {
        $result = [];
        $albums = $entities->items;

        try {
            $sortedAlbums = $this->sortAlbumsArrayByName($albums);
            $processableAlbums = $this->removeDuplicateItems($sortedAlbums);

            /** @var AlbumItems $album */
            foreach ($processableAlbums as $album) {
                $result[] = [
                    'spotify_id' => $album->id,
                    'name' => $album->name,
                    'release_date' => DateTimeHelper::getReleaseDateString($album->release_date),
                    'total_tracks' => $album->total_tracks,
                    'url' => $album->external_urls->spotify
                ];
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return $result;
    }

    /**
     * The structure of the response of artist's albums array is the following:
     * [
     * 0 => ['name' => 'value', 'other key' => 'value'],
     * 1 => ['name' => 'value', 'other key' => 'value']
     * ...,
     * ...,
     * 20 => ['name' => 'value', 'other key' => 'value']
     * ]
     * For some reason, there are arrays that have the same value for the 'name' key, as well as other keys, but they have different ids
     * This method removes arrays with duplicate 'name' values
     */
    private function removeDuplicateItems(array $originalAlbumsArray): array
    {
        $updatedAlbumsArray = [];

        for ($i = 0; $i < count($originalAlbumsArray) - 1; $i++) {
            if ($originalAlbumsArray[$i]->name === $originalAlbumsArray[$i + 1]->name) {
                unset($originalAlbumsArray[$i]);
                $updatedAlbumsArray = array_values($originalAlbumsArray);
            }
        }

        return $updatedAlbumsArray;
    }

    private function sortAlbumsArrayByName(array $albums): array
    {
        usort($albums, function ($first, $second) {
            return $first->name <=> $second->name;
        });

        return $albums;
    }
}
