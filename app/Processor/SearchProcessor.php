<?php

namespace App\Processor;

use JsonMapper;

class SearchProcessor extends BaseProcessor
{
    public function __construct(protected JsonMapper $mapper)
    {
        $this->mapper->bEnforceMapType = false;
    }

    protected function process(object $entities): array
    {
        return (array)$entities;
    }
}
