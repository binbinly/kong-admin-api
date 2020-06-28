<?php


namespace Kong\Bean\Plugin\Security;


use Kong\Bean\Plugin\PluginConfig;

/**
 * 通过启用此插件，可以将跨域资源共享（CORS）轻松添加到“服务，一条路线”中。
 * curl -X POST http://kong:8001/routes/{route}/plugins \
 * --data "name=cors"  \
 * --data "config.origins=http://mockbin.com" \
 * --data "config.methods=GET" \
 * --data "config.methods=POST" \
 * --data "config.headers=Accept" \
 * --data "config.headers=Accept-Version" \
 * --data "config.headers=Content-Length" \
 * --data "config.headers=Content-MD5" \
 * --data "config.headers=Content-Type" \
 * --data "config.headers=Date" \
 * --data "config.headers=X-Auth-Token" \
 * --data "config.exposed_headers=X-Auth-Token" \
 * --data "config.credentials=true" \
 * --data "config.max_age=3600"
 * Class CORS
 * @package Kong\Bean\Plugin\Security
 */
class CORS extends PluginConfig
{
    protected $name = 'cors';

    /**
     * Access-Control-Allow-Origin标头允许的域列表。如果您希望允许所有来源，
     * 请将*单个值添加到此配置字段。可接受的值可以是扁平字符串或PCRE正则表达式。
     * 注意：在Kong 0.10.x之前，此参数为config.origin（请注意尾随的变化s），并且仅接受单个值或*特殊值。
     * @var string
     */
    protected $origins;

    /**
     * Access-Control-Allow-Methods标头的值
     * 默认：GET, HEAD, PUT, PATCH, POST, DELETE, OPTIONS, TRACE, CONNECT
     * @var
     */
    protected $methods;

    /**
     * Access-Control-Allow-Headers标头的值
     * 默认值：Access-Control-Request-Headers请求标头的值
     * @var
     */
    protected $headers;

    /**
     * Access-Control-Expose-Headers标头的值。如果未指定，则不会公开任何自定义标头。
     * @var
     */
    protected $exposed_headers;

    /**
     * 用于确定是否Access-Control-Allow-Credentials应将标头true作为值发送的标志。
     * @var bool
     */
    protected $credentials = false;

    /**
     * 表示可以将预检请求的结果缓存多长时间 seconds
     * @var
     */
    protected $max_age;

    /**
     * 一个布尔值，指示插件将OPTIONS预检请求代理到上游服务。
     * @var bool
     */
    protected $preflight_continue = false;

    /**
     * @param string $origins
     * @return self
     */
    public function setOrigins(string $origins): self
    {
        $this->origins = $origins;
        return $this;
    }

    /**
     * @param mixed $methods
     * @return self
     */
    public function setMethods($methods): self
    {
        $this->methods = $methods;
        return $this;
    }

    /**
     * @param mixed $headers
     * @return self
     */
    public function setHeaders($headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @param mixed $exposed_headers
     * @return self
     */
    public function setExposedHeaders($exposed_headers): self
    {
        $this->exposed_headers = $exposed_headers;
        return $this;
    }

    /**
     * @param bool $credentials
     * @return self
     */
    public function setCredentials(bool $credentials): self
    {
        $this->credentials = $credentials;
        return $this;
    }

    /**
     * @param mixed $max_age
     * @return self
     */
    public function setMaxAge($max_age): self
    {
        $this->max_age = $max_age;
        return $this;
    }

    /**
     * @param bool $preflight_continue
     * @return self
     */
    public function setPreflightContinue(bool $preflight_continue): self
    {
        $this->preflight_continue = $preflight_continue;
        return $this;
    }
}