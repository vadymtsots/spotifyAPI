<?php

namespace App\Processor;

use App\Mappers\Artist\Artist;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;
use JsonMapper;
use JsonMapper_Exception;
use phpDocumentor\Reflection\Types\ClassString;


abstract class BaseProcessor
{
    public function __construct(protected JsonMapper $mapper)
    {
    }
    /**
     * @param Response $response
     * @return array
     */
    public function get($response, $object)
    {
        try {
            $jsonArray = $this->parseJsonToArray($response);
            $entities = (object)$this->mapJson($jsonArray, $object);
            return $this->process($entities);
        } catch (JsonMapper_Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * @param Response $response
     * @return mixed
     */
    private function parseJsonToArray($response)
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

    /**
     * @param object $entities
     * @return mixed
     */
    abstract protected function process(object $entities);
}
