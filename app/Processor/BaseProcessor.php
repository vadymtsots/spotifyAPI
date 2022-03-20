<?php

namespace App\Processor;

use Illuminate\Http\Client\Response;

abstract class BaseProcessor
{
    /**
     * @param Response $response
     * @return array
     */
    public function get(Response $response): array
    {
        $entities = $this->parseJsonToArray($response);
        return $this->process($entities);
    }

    /**
     * @param Response $response
     * @return mixed
     */
    private function parseJsonToArray(Response $response)
    {
        return json_decode($response, true);
    }

    /**
     * @param array $entities
     * @return mixed
     */
    abstract protected function process(array $entities);
}
