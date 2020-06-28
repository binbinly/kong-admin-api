<?php

namespace Kong\Bean;


/**
 * 顾名思义，服务实体是您自己的每个上游服务的抽象。服务的示例将是数据转换微服务，计费Bean等。
 *
 * 服务的主要属性是它的URL（其中，孔应该代理流量），其可以被设置为单个串或通过指定其protocol， host，port和path单独地。
 *
 * 服务与路由关联（一个服务可以有许多与之关联的路由）。路由是Kong中的入口点，并定义规则以匹配客户请求。路线匹配后，
 * Kong将请求代理到其关联的服务。有关Kong代理流量的详细说明
 * @package Kong\Bean
 */
class Service extends Base
{
    /**
     * 服务名称
     * @var string
     */
    protected $name;

    /**
     * 与上游通信的协议。可接受的值是："grpc"，"grpcs"，"http"，"https"，"tcp"，"tls"。默认为"http"
     * @var string
     */
    protected $protocol;

    /**
     * 上游服务器的主机
     * @var string
     */
    protected $host;

    /**
     * 上游服务器端口。默认为80
     * @var int
     */
    protected $port;

    /**
     * 到上游服务器的请求中要使用的路径
     * @var string
     */
    protected $path;

    /**
     * 代理失败后要执行的重试次数。默认为5
     * @var int
     */
    protected $retries;

    /**
     * 建立到上游服务器的连接的超时时间（以毫秒为单位）。默认为60000
     * @var int
     */
    protected $connect_timeout;

    /**
     * 用于将请求传输到上游服务器的两个连续写操作之间的超时（以毫秒为单位）。默认为60000
     * @var int
     */
    protected $write_timeout;

    /**
     * 两次连续读取操作之间的超时（以毫秒为单位），用于将请求传输到上游服务器。默认为60000
     * @var int
     */
    protected $read_timeout;

    /**
     * 在与上游服务器进行TLS握手时，将用作客户端证书的证书。使用形式编码时，符号为client_certificate.id=<client_certificate id>。对于JSON，请使用“” "client_certificate":{"id":"<client_certificate id>"}
     * @var string
     */
    protected $client_certificate;

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $protocol
     * @return self
     */
    public function setProtocol(string $protocol): self
    {
        $this->protocol = $protocol;
        return $this;
    }

    /**
     * @param string $host
     * @return self
     */
    public function setHost(string $host): self
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @param int $port
     * @return self
     */
    public function setPort(int $port): self
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @param string $path
     * @return self
     */
    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param int $retries
     * @return self
     */
    public function setRetries(int $retries): self
    {
        $this->retries = $retries;
        return $this;
    }

    /**
     * @param int $connect_timeout
     * @return self
     */
    public function setConnectTimeout(int $connect_timeout): self
    {
        $this->connect_timeout = $connect_timeout;
        return $this;
    }

    /**
     * @param int $write_timeout
     * @return self
     */
    public function setWriteTimeout(int $write_timeout): self
    {
        $this->write_timeout = $write_timeout;
        return $this;
    }

    /**
     * @param int $read_timeout
     * @return self
     */
    public function setReadTimeout(int $read_timeout): self
    {
        $this->read_timeout = $read_timeout;
        return $this;
    }

    /**
     * @param string $client_certificate
     * @return self
     */
    public function setClientCertificate(string $client_certificate): self
    {
        $this->client_certificate = $client_certificate;
        return $this;
    }

    /**
     * 速记属性集protocol，host，port和path一次
     * @param string $uri
     */
    public function setUri(string $uri)
    {
        $this->protocol = parse_url($uri, PHP_URL_SCHEME);
        $this->host = parse_url($uri, PHP_URL_HOST);
        $this->port = parse_url($uri, PHP_URL_PORT) ?? self::DEFAULT_PORT;
        $this->path = parse_url($uri, PHP_URL_PATH);
    }
}
