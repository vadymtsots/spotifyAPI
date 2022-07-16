<?php

namespace App\Processor;

class SearchProcessor extends BaseProcessor
{

    protected function process(object $entities): array
    {
        return (array)$entities;
    }
}
