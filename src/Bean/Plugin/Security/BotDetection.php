<?php


namespace Kong\Bean\Plugin\Security;


use Kong\Bean\Plugin\PluginConfig;

/**
 * 机器人检测 - 保护服务或路由免受大多数常见漫游器的侵害，并具有将自定义客户端列入白名单和黑名单的功能
 * curl -X POST http://kong:8001/routes/{route}/plugins \
 * --data "name=bot-detection"
 * Class BotDetection
 * @package Kong\Bean\Plugin
 */
class BotDetection extends PluginConfig
{
    protected $name = 'bot-detection';

    /**
     * 一组应列入白名单的正则表达式。正则表达式将根据User-Agent标题进行检查。
     * @var array
     */
    protected $whitelist;

    /**
     * 正则表达式数组，应将其列入黑名单。正则表达式将根据User-Agent标题进行检查。
     * @var array
     */
    protected $blacklist;

    /**
     * @param array $whitelist
     * @return self
     */
    public function setWhitelist(array $whitelist): self
    {
        $this->whitelist = $whitelist;
        return $this;
    }

    /**
     * @param array $blacklist
     * @return self
     */
    public function setBlacklist(array $blacklist): self
    {
        $this->blacklist = $blacklist;
        return $this;
    }
}