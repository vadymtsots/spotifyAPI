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

    /**
     * @param Response $response
     * @param $object
     * @return array
     */
    public function get(Response $response, $object): array
    {
        try {
            $jsonArray = $this->parseJson($response);
            $entities = $this->mapJson($jsonArray, $object);
            return $this->process($entities);
        } catch (JsonMapper_Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * @param Response $response
     * @return mixed
     */
    private function parseJson(Response $response): mixed
    {
        return json_decode($response);
    }

    /**
     * @param $json
     * @param $object
     * @return mixed|object|void
     */
    protected function mapJson($json, $object)
    {
        try {
            return $this->mapper->map($json, $object);
        } catch(JsonMapper_Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * @param object $entities
     * @return mixed
     */
    abstract protected function process(object $entities): array;
}
