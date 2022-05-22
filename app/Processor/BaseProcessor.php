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
    }

    public function get(Response $response, $object): array
    {
        $jsonArray = $this->parseJson($response);
        $entities = $this->mapJson($jsonArray, $object);

        return $this->process($entities);
    }

    private function parseJson(Response $response): mixed
    {
        return json_decode($response);
    }

    protected function mapJson($json, $object)
    {
        try {
            return $this->mapper->map($json, $object);
        } catch(JsonMapper_Exception $e) {
            Log::error($e->getMessage());
        }
    }

    abstract protected function process(object $entities): array;
}
