<?php

namespace App\Processor;

abstract class BaseProcessor
{
    public function get(array $spotifyResponse, object $object): array
    {
        $entities = $this->mapper->map($spotifyResponse, $object);

        return $this->process($entities);
    }

    abstract protected function process(object $entities): array;
}
