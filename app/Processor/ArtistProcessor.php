<?php

namespace App\Processor;

use App\Mappers\Artist\Artist;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\ArrayShape;
use JsonMapper_Exception;
use NumberFormatter;
use stdClass;

class ArtistProcessor extends BaseProcessor
{
    protected function mapJson($json, $object)
    {
        try {
            return $this->mapper->map($json, $object);
        } catch(JsonMapper_Exception $e) {
            Log::error($e->getMessage());
        }
    }

    protected function process(object $entities)
   {
        return [
            'name' => $entities->name,
            'followers' => number_format($entities->followers->total),
            'genres' => $entities->genres
        ];
   }
}
