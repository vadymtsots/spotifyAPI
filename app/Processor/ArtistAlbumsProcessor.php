<?php

namespace App\Processor;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\ArrayShape;

class ArtistAlbumsProcessor extends BaseProcessor
{
    /**
     * @param array $entities
     * @return array
     */
   protected function process(array $entities): array
   {
       $result = [];
       $albums = $entities['items'];
       try {
           $albums = $this->sort($albums);
           $albums = $this->removeDuplicateItems($albums);

           foreach ($albums as $album) {
               $result[] = [
                   'spotify_id' => $album['id'],
                   'name' => $album['name'],
                   'release_date' => Date::createFromTimestamp(strtotime($album['release_date']))->format('j F Y'),
                   'total_tracks' => $album['total_tracks']
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
     * For some reason, there are arrays that have the same value for the 'name' key, as well as other keys, but thay have different ids
     * This method removes arrays with duplicate 'name' values
     * @param array $albums
     * @return array
     */
    private function removeDuplicateItems(array $albums): array
    {
        for ($i = 0; $i < count($albums) - 1; $i++) {
            if ($albums[$i]['name'] === $albums[$i + 1]['name']) {
                unset($albums[$i]);
                $albums = array_values($albums);
            }
        }
        return $albums;
    }

    /**
     * This sorts the multidimensional artist's albums array by the 'name' key
     * @param array $albums
     * @return array
     */
    private function sort(array $albums): array
    {
        usort($albums, function ($current, $next) {
            return $current['name'] <=> $next['name'];
        });

        return $albums;
    }
}
