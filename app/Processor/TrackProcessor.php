<?php

namespace App\Processor;

use App\Helpers\DateTimeHelper;

class TrackProcessor extends BaseProcessor
{
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
