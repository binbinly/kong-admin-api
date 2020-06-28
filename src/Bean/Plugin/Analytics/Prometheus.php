<?php

namespace Kong\Bean\Plugin\Analytics;

use Kong\Bean\Plugin\PluginConfig;

/**
 * 普罗米修斯 - 以Prometheus展示格式公开与Kong和代理的上游服务相关的度量标准，可以通过Prometheus Server进行抓取。
 * https://docs.konghq.com/hub/kong-inc/prometheus/
 * Class Prometheus
 * @package Kong\Bean\Plugin\Analytics
 */
class Prometheus extends PluginConfig
{
    protected $name = 'prometheus';
}