<?php

namespace Kong\Bean;


/**
 * 路由实体定义规则以匹配客户端请求。每个路由都与服务关联，并且一个服务可能具有与其关联的多个路由。匹配给定路线的每个请求都将被代理到其关联的服务。
 *
 * 路由和服务的组合（以及它们之间的关注点分离）提供了一种强大的路由机制，通过它可以在Kong中定义细粒度的入口点，从而导致基础结构的不同上游服务。
 *
 * 您需要至少一个匹配规则，该规则适用于路由要匹配的协议。取决于配置为与路由匹配的协议（通过该protocols字段定义），这意味着必须设置以下属性中的至少一个：
 *
 * 为http，中的至少一个methods，hosts，headers或paths;
 * 为https，中的至少一个methods，hosts，headers，paths或snis;
 * 为tcp，至少一个sources或destinations;
 * 为tls，至少一个的sources，destinations或snis;
 * 为grpc，至少一个的hosts，headers或paths;
 * 为grpcs，中的至少一个hosts，headers，paths或snis。
 * 固定链接路径处理算法
 * "v0"是Kong 0.x和2.x中使用的行为。它把service.path，route.path并作为请求路径 段的URL的。
 * 它将始终通过斜杠加入它们。给定服务路径/s，路由路径/r 和请求路径/re，串联路径为/s/re。
 * 如果生成的路径是单个斜杠，则不会对其进行进一步的转换。如果更长，则尾部的斜杠将被删除。
 *
 * "v1"是Kong 1.x中使用的行为。它将service.path作为前缀，并忽略请求路径和路由路径的初始斜线。给定服务路径/s，路由路径/r和请求路径/re，串联路径为/sre。
 *
 * 组合路径时，两种算法版本都检测到“双斜杠”，将其替换为单斜杠。
 *
 * 下表s是“服务”和r“路线”。
 *
 * s.path    r.path    r.strip_path    r.path_handling    请求路径    代理路径
 * /s       /fv0        false           v0              /fv0req    /s/fv0req
 * /s       /fv1        false           v1              /fv1req    /sfv1req
 * /s       /tv0        true            v0              /tv0req    /s/req
 * /s       /tv1        true            v1              /tv1req    /sreq
 * /s       /fv0/       false           v0              /fv0/req    /s/fv0/req
 * /s       /fv1/       false           v1              /fv1/req    /sfv1/req
 * /s       /tv0/       true            v0              /tv0/req    /s/req
 * /s       /tv1/       true            v1              /tv1/req    /sreq
 * Class Route
 * @package Kong\Bean
 */
class Route extends Base
{
    /**
     * 路由名称
     * @var string
     */
    protected $name;

    /**
     * 此路由允许的协议列表。设置["https"]为时，将以升级到HTTPS的请求回答HTTP请求。默认为["http", "https"]
     * @var array
     */
    public $protocols;

    /**
     * 与此路由匹配的HTTP方法的列表。
     * @var array
     */
    public $methods;

    /**
     * 与此路由匹配的域名列表。使用形式编码时，符号为hosts[]=example.com&hosts[]=foo.test。对于JSON，请使用Array。
     * @var array
     */
    public $hosts;

    /**
     * 与此路由匹配的路径列表。使用形式编码时，符号为paths[]=/foo&paths[]=/bar。对于JSON，请使用Array
     * @var array
     */
    public $paths;

    /**
     * 由标头名称索引的一个或多个值列表，如果请求中存在此路由，则将导致此路由匹配。的Host报头可以不与本属性应用于：主机应该使用来指定hosts属性
     * @var
     */
    protected $headers;

    /**
     * 当路由的所有属性（协议除外）都匹配时，即请求的协议HTTP不是时，
     * 状态码Kong就会响应HTTPS。Location报头由Kong注入,如果该字段被设置为301，302，307或308接受的值是：426，301，302，307，308。默认为426
     * @var int
     */
    protected $https_redirect_status_code;

    /**
     * 当多个路由同时使用正则表达式匹配时，用于选择哪个路由解析给定请求的数字。
     * 当两条路线与路径匹配且具有相同时regex_priority，将使用较旧的路线（最低created_at）。
     * 请注意，非正则表达式路由的优先级不同（较长的非正则表达式路由在较短的路由之前匹配）。默认为0
     * @var int
     */
    public $regex_priority;

    /**
     * 通过之一paths匹配路由时，请从上游请求网址中删除匹配的前缀。默认为true
     * @var bool
     */
    public $strip_path = true;

    /**
     * 控制在向上游发送请求时如何组合服务路径，路由路径和请求的路径。有关每种行为的详细说明，请参见上文。可接受的值为："v0"，"v1"。默认为"v0"
     * @var string
     */
    protected $path_handling;

    /**
     * 通过hosts域名之一匹配路由时，请Host在上游请求标头中使用请求标头。如果设置为false，则上游标Host头将是Service的标头host
     * @var bool
     */
    public $preserve_host = false;

    /**
     * 此路由所关联的服务。这是路由代理访问的目的地。使用形式编码时，符号为service.id=<service id>或service.name=<service name>。
     * 对于JSON，请使用“ "service":{"id":"<service id>"}或” "service":{"name":"<service name>"}
     * @var string
     */
    protected $service;

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
     * @param array $protocols
     * @return self
     */
    public function setProtocols(array $protocols): self
    {
        $this->protocols = $protocols;
        return $this;
    }

    /**
     * @param array $methods
     * @return self
     */
    public function setMethods(array $methods): self
    {
        $this->methods = $methods;
        return $this;
    }

    /**
     * @param array $hosts
     * @return self
     */
    public function setHosts(array $hosts): self
    {
        $this->hosts = $hosts;
        return $this;
    }

    /**
     * @param array $paths
     * @return self
     */
    public function setPaths(array $paths): self
    {
        $this->paths = $paths;
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
     * @param int $https_redirect_status_code
     * @return self
     */
    public function setHttpsRedirectStatusCode(int $https_redirect_status_code): self
    {
        $this->https_redirect_status_code = $https_redirect_status_code;
        return $this;
    }

    /**
     * @param int $regex_priority
     * @return self
     */
    public function setRegexPriority(int $regex_priority): self
    {
        $this->regex_priority = $regex_priority;
        return $this;
    }

    /**
     * @param bool $strip_path
     * @return self
     */
    public function setStripPath(bool $strip_path): self
    {
        $this->strip_path = $strip_path;
        return $this;
    }

    /**
     * @param string $path_handling
     * @return self
     */
    public function setPathHandling(string $path_handling): self
    {
        $this->path_handling = $path_handling;
        return $this;
    }

    /**
     * @param bool $preserve_host
     * @return self
     */
    public function setPreserveHost(bool $preserve_host): self
    {
        $this->preserve_host = $preserve_host;
        return $this;
    }

    /**
     * @param string $service
     * @return self
     */
    public function setService(string $service): self
    {
        $this->service = $service;
        return $this;
    }

}
