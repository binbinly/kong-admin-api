<?php

namespace Kong\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HttpClient
{
    const SUCCESS = 200;

    /**
     * Request options.
     *
     * @var array
     */
    private $options;

    /**
     * @var Client
     */
    private $client;

    /**
     * @param array  $options Guzzle options array
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;

        $this->client = new Client($options);
    }

    /**
     * @param $url
     * @param array $headers
     * @return string
     * @throws GuzzleException
     */
    public function get($url, $headers = [])
    {
        return $this->request('GET', $url, [], $headers);
    }

    /**
     * @param $url
     * @param array $body
     * @param array $header
     * @return string
     * @throws GuzzleException
     */
    public function post($url, $body = [], $header = []){
        return $this->request('POST', $url, $body, $header);
    }

    /**
     * @param $url
     * @param array $body
     * @param array $headers
     * @return string
     * @throws GuzzleException
     */
    public function delete($url, $body = [], $headers = [])
    {
        return $this->request('DELETE', $url, $body, $headers);
    }

    /**
     * @param $url
     * @param array $body
     * @param array $headers
     * @return string
     * @throws GuzzleException
     */
    public function patch($url, $body = [], $headers = [])
    {
        return $this->request('PATCH', $url, $body, $headers);
    }

    /**
     * @param $url
     * @param array $body
     * @param array $headers
     * @return string
     * @throws GuzzleException
     */
    public function put($url, $body = [], $headers = [])
    {
        return $this->request('PUT', $url, $body, $headers);
    }

    /**
     * 发起请求
     * @param $method
     * @param $url
     * @param array $body
     * @param array $headers
     * @return string
     * @throws GuzzleException
     */
    private function request($method, $url, $body = [], $headers = [])
    {
        if (!empty($body)) {
            $headers['Content-Type'] = 'application/json';
        }

        $response = $this->client->request($method, $url, [
            'headers' => $headers,
            'json'    => $body,
        ]);
        return $response->getBody()->getContents();
    }

}
