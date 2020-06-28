<?php

namespace Kong\Service;

use Kong\Bean\ArrayAble;
use Kong\Http\HttpClient;
use GuzzleHttp\Exception\GuzzleException;

class Base
{
    protected $route;

    /**
     * @var HttpClient
     */
    protected $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * 添加
     * @param ArrayAble $bean
     * @return string
     * @throws GuzzleException
     */
    public function add(ArrayAble $bean)
    {
        return $this->client->post($this->route, $bean->toArray());
    }

    /**
     * 删除
     * @param $id
     * @return string
     * @throws GuzzleException
     */
    public function del($id)
    {
        return $this->client->delete($this->route . '/' . $id);
    }

    /**
     * 更新
     * @param $id
     * @param ArrayAble $bean
     * @return string
     * @throws GuzzleException
     */
    public function edit($id, ArrayAble $bean)
    {
        return $this->client->patch($this->route . '/' . $id, $bean->toArray());
    }

    /**
     * 检索
     * @param $id
     * @return string
     * @throws GuzzleException
     */
    public function find($id)
    {
        return $this->client->get($this->route . '/' . $id);
    }

    /**
     * 列表
     * @return string
     * @throws GuzzleException
     */
    public function list()
    {
        return $this->client->get($this->route);
    }
}