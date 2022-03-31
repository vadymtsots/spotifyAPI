<?php

namespace App\Processor;

use App\Helpers\DateTimeHelper;
use App\Mappers\Track\Track;
use JetBrains\PhpStorm\ArrayShape;

class TrackProcessor extends BaseProcessor
{
    /**
     * @param Track $entities
     * @return array
     */
    #[ArrayShape(['id' => "string", 'name' => "string", 'popularity' => "int", 'url' => "mixed", 'duration' => "string"])]
    protected function process($entities): array
    {
        return [
            'id' => $entities->id,
            'name' => $entities->name,
            'popularity' => $entities->popularity,
            'url' => $entities->external_urls->spotify,
            'duration' => DateTimeHelper::getTimeString($entities->duration_ms),
        ];
    }
}
