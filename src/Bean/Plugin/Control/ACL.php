<?php

namespace Kong\Bean\Plugin\Control;

use Kong\Bean\Plugin\PluginConfig;

/**
 * 访问控制列表 - 通过使用任意ACL组名称将使用者列入白名单或黑名单来限制对服务或路由的访问。此插件需要在服务或路由上已启用身份验证插件。
 * Class ACL
 * @package Kong\Bean\Plugin\Control
 */
class ACL extends PluginConfig
{
    protected $name = 'acl';

    /**
     * 允许使用服务或路由的任意组名。必须指定config.whitelist或之一config.blacklist。
     * @var
     */
    protected $whitelist;

    /**
     * 不允许使用服务或路由的任意组名。必须指定config.whitelist或之一config.blacklist。
     * @var
     */
    protected $blacklist;

    /**
     * 标记，如果启用该标记（true），则阻止X-Consumer-Groups在请求中将标头发送到上游服务。
     * @var
     */
    protected $hide_groups_header = false;

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

    /**
     * @param mixed $hide_groups_header
     * @return self
     */
    public function setHideGroupsHeader($hide_groups_header): self
    {
        $this->hide_groups_header = $hide_groups_header;
        return $this;
    }
}