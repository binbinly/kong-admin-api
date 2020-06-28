<?php

namespace Kong\Bean;


/**
 * 插件实体表示将在HTTP请求/响应生命周期内执行的插件配置。通过这种方法，您可以为在Kong后面运行的服务添加功能，
 * 例如身份验证或速率限制。您可以通过访问Kong Hub来找到有关如何安装以及每个插件采用什么值的更多信息。
 *
 * 当向服务添加插件配置时，客户端对该服务的每个请求都将运行所述插件。如果某个插件需要针对某些特定使用者调整为不同的值，
 * 则可以通过service和consumer字段创建一个单独的插件实例来指定服务和使用者，从而做到这一点 。
 * Class Plugin
 * @package Kong\Bean\Plugin
 */
class Plugin extends Base
{
    /**
     * 将要添加的插件的名称。当前，必须在每个Kong实例中分别安装插件。
     * @var string
     */
    protected $name;

    /**
     * 如果设置，则仅当通过属于指定服务的路由之一接收到请求时，插件才会激活。保持未设置状态，无论服务是否匹配，插件均可激活。
     * 默认为。使用null形式编码的符号为service.id=<service id>或service.name=<service name>。
     * 对于JSON，请使用“ "service":{"id":"<service id>"}或” "service":{"name":"<service name>"}。
     * @var string
     */
    protected $service_id;

    /**
     * 如果设置，则仅当通过指定的路由接收请求时，插件才会激活。不管使用哪种路由，都请保留未设置状态以使插件激活。
     * 默认为。使用null形式编码的符号为route.id=<route id>或route.name=<route name>。
     * 对于JSON，请使用“ "route":{"id":"<route id>"}或” "route":{"name":"<route name>"}。
     * @var string
     */
    protected $route_id;

    /**
     * 如果设置，则该插件仅对指定的身份验证的请求激活。（请注意，某些插件不能以这种方式仅限于消费者。）不管身份验证的使用者如何，都无需设置插件即可激活。
     * 默认为。使用null形式编码的符号为consumer.id=<consumer id>或consumer.username=<consumer username>。
     * 对于JSON，请使用“ "consumer":{"id":"<consumer id>"}或” "consumer":{"username":"<consumer username>"}。
     * @var string
     */
    protected $consumer;

    /**
     * 插件的配置属性可以在Kong Hub的插件文档页面上找到。
     * @var array
     */
    protected $config;

    /**
     * 将触发此插件的请求协议的列表。默认值以及此字段上允许的可能值可能会根据插件类型而变化。
     * 例如，仅在流模式下工作的插件仅支持"tcp"和"tls"。默认为["grpc", "grpcs", "http", "https"]。
     * @var string
     */
    protected $protocols;

    /**
     * 是否应用了插件。默认为true。
     * @var bool
     */
    protected $enabled = true;

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
     * @param string $service_id
     * @return self
     */
    public function setServiceId(string $service_id): self
    {
        $this->service_id = $service_id;
        return $this;
    }

    /**
     * @param string $route_id
     * @return self
     */
    public function setRouteId(string $route_id): self
    {
        $this->route_id = $route_id;
        return $this;
    }

    /**
     * @param string $consumer
     * @return self
     */
    public function setConsumer(string $consumer): self
    {
        $this->consumer = $consumer;
        return $this;
    }

    /**
     * @param array $config
     * @return self
     */
    public function setConfig(array $config): self
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @param string $protocols
     * @return self
     */
    public function setProtocols(string $protocols): self
    {
        $this->protocols = $protocols;
        return $this;
    }

    /**
     * @param bool $enabled
     * @return self
     */
    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;
        return $this;
    }
    
}
