<?php

namespace App\Processor;

abstract class BaseProcessor
{
    public function get(array $artistAlbums): array
    {
        return $this->process($artistAlbums);
    }

    abstract protected function process(array $entities);
}
