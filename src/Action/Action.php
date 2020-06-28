<?php

namespace Kong\Action;

use Kong\Http\HttpClient;

abstract class Action
{
    /**
     * @var HttpClient
     */
    protected $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * json解码
     * @param string $json
     * @return array
     */
    protected function jsonDecode(string $json){
        return json_decode($json, true);
    }
}