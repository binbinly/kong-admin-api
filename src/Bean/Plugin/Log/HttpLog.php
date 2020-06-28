<?php

namespace Kong\Bean\Plugin\Log;

use Kong\Bean\Plugin\PluginConfig;

/**
 * 将请求和响应日志发送到HTTP服务器。
 * https://docs.konghq.com/hub/kong-inc/http-log/
 * Class HttpLog
 * @package Kong\Bean\Plugin\Log
 */
class HttpLog extends PluginConfig
{
    protected $name = 'http_log';

    /**
     * 数据将发送到的HTTP端点（包括要使用的协议）。
     * @var
     */
    protected $http_endpoint;

    /**
     * 用于将数据发送到http服务器的可选方法，其他受支持的值为PUT，PATCH
     * 默认值：POST
     * @var
     */
    protected $method;

    /**
     * 向上游服务器发送数据时的可选超时（以毫秒为单位）
     * 默认值：10000
     * @var
     */
    protected $timeout;

    /**
     * 可选值（以毫秒为单位），用于定义空闲连接在关闭之前将存活多长时间
     * 默认值：60000
     * @var
     */
    protected $keepalive;

    /**
     * @param mixed $http_endpoint
     * @return self
     */
    public function setHttpEndpoint($http_endpoint): self
    {
        $this->http_endpoint = $http_endpoint;
        return $this;
    }

    /**
     * @param mixed $method
     * @return self
     */
    public function setMethod($method): self
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @param mixed $timeout
     * @return self
     */
    public function setTimeout($timeout): self
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @param mixed $keepalive
     * @return self
     */
    public function setKeepalive($keepalive): self
    {
        $this->keepalive = $keepalive;
        return $this;
    }

}