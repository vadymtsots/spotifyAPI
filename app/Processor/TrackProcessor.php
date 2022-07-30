<?php

namespace App\Processor;

use App\Dto\Mapper;
use App\Helpers\DateTimeHelper;
use JsonMapper;

class TrackProcessor extends BaseProcessor
{
    public function __construct(protected JsonMapper $mapper)
    {
        $this->mapper->bEnforceMapType = false;
    }

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
