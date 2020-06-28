<?php


namespace Kong\Bean\Plugin\Control;


use Kong\Bean\Plugin\PluginConfig;

/**
 * 请求终止 - 该插件使用指定的状态代码和消息终止传入的请求。这允许（临时）停止服务或路线上的流量，甚至阻止使用者。
 * 使用场景
 * 暂时禁用服务（例如，正在维护中）。
 * 暂时禁用路由（例如，其余服务已启动并正在运行，但是必须禁用特定端点）。
 * 暂时禁用使用者（例如，过度消耗）。
 * 在逻辑OR设置中使用多个auth插件阻止匿名访问
 * Class RequestTermination
 * @package Kong\Bean\Plugin\Control
 */
class RequestTermination extends PluginConfig
{
    protected $name = 'request-termination';

    /**
     * 发送的响应码。
     * 默认值：503
     * @var
     */
    protected $status_code;

    /**
     * 要发送的消息（如果使用默认响应生成器）。
     * @var
     */
    protected $message;

    /**
     * 原始响应正文发送，这与config.message字段是互斥的。
     * @var
     */
    protected $body;

    /**
     * 配置为的原始响应的内容类型config.body
     * 默认值 application/json; charset=utf-8
     * @var
     */
    protected $content_type;

    /**
     * @param mixed $status_code
     * @return self
     */
    public function setStatusCode($status_code): self
    {
        $this->status_code = $status_code;
        return $this;
    }

    /**
     * @param mixed $message
     * @return self
     */
    public function setMessage($message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param mixed $body
     * @return self
     */
    public function setBody($body): self
    {
        $this->body = $body;
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
}