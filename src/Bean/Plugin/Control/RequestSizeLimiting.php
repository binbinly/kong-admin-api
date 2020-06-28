<?php


namespace Kong\Bean\Plugin\Control;


use Kong\Bean\Plugin\PluginConfig;


/**
 * 阻止正文大于特定大小（以兆字节为单位）的传入请求。
 * curl -X POST http://kong:8001/services/{service}/plugins \
 * --data "name=request-size-limiting"  \
 * --data "config.allowed_payload_size=128" \
 * --data "config.size_unit=megabytes"
 * Class RequestSizeLimiting
 * @package Kong\Bean\Plugin\Control
 */
class RequestSizeLimiting extends PluginConfig
{
    protected $name = 'request-size-limiting';

    /**
     * 允许的请求有效负载大小（以兆128字节为单位），默认值为（128000000字节）
     * 默认值：128
     * @var
     */
    protected $allowed_payload_size;

    /**
     * 大小单位可以在被设置bytes，kilobytes或megabytes。注意-此配置仅在Kong Enterprise 1.3及更高版本中受支持，并且最终可能会扩展到Kong Gateway
     * 默认值：megabytes
     * @var
     */
    protected $size_unit;

    /**
     * @param mixed $allowed_payload_size
     * @return self
     */
    public function setAllowedPayloadSize($allowed_payload_size): self
    {
        $this->allowed_payload_size = $allowed_payload_size;
        return $this;
    }

    /**
     * @param mixed $size_unit
     * @return self
     */
    public function setSizeUnit($size_unit): self
    {
        $this->size_unit = $size_unit;
        return $this;
    }
}