<?php


namespace Kong\Bean\Plugin\Control;


use Kong\Bean\Plugin\PluginConfig;


/**
 * 该插件为Kong提供了反向代理缓存实现。它根据可配置的响应代码和内容类型以及请求方法来缓存响应实体。
 * 它可以缓存每个消费者或每个API。缓存实体将存储一段可配置的时间，在此之后，对同一资源的后续请求将重新获取并重新存储该资源。
 * 也可以在到期之前通过Admin API强制清除缓存实体
 * curl -X POST http://kong:8001/routes/{route}/plugins \
 * --data "name=proxy-cache"  \
 * --data "config.strategy=memory"
 * Class ProxyCache
 * @package Kong\Bean\Plugin\Control
 */
class ProxyCache extends PluginConfig
{
    protected $name = 'proxy-cache';

    /**
     * 上游响应状态代码被认为可缓存
     * 默认值：200、301、404
     * @var
     */
    protected $response_code;

    /**
     * 下游请求方法可缓存
     * 默认值：GET，HEAD
     * @var
     */
    protected $request_method;

    /**
     * 上游响应内容类型被认为是可缓存的。插件会针对每个指定值执行完全匹配；
     * 例如，如果预期上游响应application/json; charset=utf-8内容类型，则插件配置必须包含所述值，否则Bypass将返回缓存状态
     * @var
     */
    protected $content_type;

    /**
     * 缓存键考虑的相关标头。如果未定义，则不考虑任何标头。
     * @var
     */
    protected $vary_headers;

    /**
     * 为缓存键考虑的相关查询参数。如果未定义，则将所有参数都考虑在内。
     * @var
     */
    protected $vary_query_params;

    /**
     * 缓存实体的TTL（以秒为单位）
     * 默认：300
     * @var
     */
    protected $cache_ttl;

    /**
     * 启用后，请遵守RFC7234中定义的Cache-Control行为
     * @var bool
     */
    protected $cache_control = false;

    /**
     * 将资源保留在存储后端中的秒数。此值独立于cache_ttl或由缓存控制行为定义的资源TTL。
     * @var
     */
    protected $storage_ttl;

    /**
     * 支持缓存实体的备份数据存储。可接受的值是；memory
     * @var
     */
    protected $strategy;

    /**
     * @param mixed $response_code
     * @return self
     */
    public function setResponseCode($response_code): self
    {
        $this->response_code = $response_code;
        return $this;
    }

    /**
     * @param mixed $request_method
     * @return self
     */
    public function setRequestMethod($request_method): self
    {
        $this->request_method = $request_method;
        return $this;
    }

    /**
     * @param mixed $content_type
     * @return self
     */
    public function setContentType($content_type): self
    {
        $this->content_type = $content_type;
        return $this;
    }

    /**
     * @param mixed $vary_headers
     * @return self
     */
    public function setVaryHeaders($vary_headers): self
    {
        $this->vary_headers = $vary_headers;
        return $this;
    }

    /**
     * @param mixed $vary_query_params
     * @return self
     */
    public function setVaryQueryParams($vary_query_params): self
    {
        $this->vary_query_params = $vary_query_params;
        return $this;
    }

    /**
     * @param mixed $cache_ttl
     * @return self
     */
    public function setCacheTtl($cache_ttl): self
    {
        $this->cache_ttl = $cache_ttl;
        return $this;
    }

    /**
     * @param bool $cache_control
     * @return self
     */
    public function setCacheControl(bool $cache_control): self
    {
        $this->cache_control = $cache_control;
        return $this;
    }

    /**
     * @param mixed $storage_ttl
     * @return self
     */
    public function setStorageTtl($storage_ttl): self
    {
        $this->storage_ttl = $storage_ttl;
        return $this;
    }

    /**
     * @param mixed $strategy
     * @return self
     */
    public function setStrategy($strategy): self
    {
        $this->strategy = $strategy;
        return $this;
    }
}