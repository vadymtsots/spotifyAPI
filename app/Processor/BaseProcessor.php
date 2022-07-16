<?php

namespace App\Processor;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;
use JsonMapper;
use JsonMapper_Exception;


abstract class BaseProcessor
{
    public function __construct(protected JsonMapper $mapper)
    {
        $this->mapper->bEnforceMapType = false;
    }

    public function get(array $spotifyResponse, object $object): array
    {
        $entities = $this->mapJson($spotifyResponse, $object);

        return $this->process($entities);
    }

    /**
     * @throws JsonMapper_Exception
     */
    protected function mapJson(array $json, object $object): object
    {
        return $this->mapper->map($json, $object);
    }

    abstract protected function process(object $entities): array;
}
