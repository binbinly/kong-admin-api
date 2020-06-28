<?php


namespace Kong\Bean\Plugin\Security;


use Kong\Bean\Plugin\PluginConfig;

/**
 * IP限制 - 通过将IP地址列入白名单或黑名单来限制对服务或路由的访问。单IP地址，多个IP地址或范围以CIDR标记一样10.10.10.0/24可以使用。该插件支持IPv4和IPv6地址。
 * curl -X POST http://kong:8001/services/{service}/plugins \
 * --data "name=ip-restriction" \
 * --data "config.whitelist=127.0.0.0/24" \
 * --data "config.blacklist=127.0.0.1"
 * Class IpRestriction
 * @package Kong\Bean\Plugin\Security
 */
class IpRestriction extends PluginConfig
{
    protected $name = 'ip-restriction';

    /**
     * IP列表或CIDR范围到白名单。必须指定config.whitelist或之一config.blacklist。
     * @var
     */
    protected $whitelist;

    /**
     * IP列表或CIDR范围到黑名单。必须指定config.whitelist或之一config.blacklist。
     * @var
     */
    protected $blacklist;

    /**
     * @param mixed $whitelist
     * @return self
     */
    public function setWhitelist($whitelist): self
    {
        $this->whitelist = $whitelist;
        return $this;
    }

    /**
     * @param mixed $blacklist
     * @return self
     */
    public function setBlacklist($blacklist): self
    {
        $this->blacklist = $blacklist;
        return $this;
    }
}