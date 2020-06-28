<?php

namespace Kong\Bean\Plugin\Auth;


use Kong\Bean\Plugin\PluginConfig;

/**
 * 使用用户名和密码保护将基本身份验证添加到服务或路由。插件将检查Proxy-Authorization和Authorization标头中的有效凭据（按此顺序）。
 * https://docs.konghq.com/hub/kong-inc/basic-auth/
 * Class BasicAuth
 * @package Kong\Bean\Plugin\Auth
 */
class BasicAuth extends PluginConfig
{
    protected $name = 'basic_auth';

    /**
     * 一个可选的布尔值，告诉插件显示或隐藏上游服务中的凭据。如果为true，则插件将Authorization在代理之前从请求（即标头）中剥离凭证。
     * @var bool
     */
    protected $hide_credentials = false;

    /**
     * 如果身份验证失败，则用作“匿名”使用者的可选字符串（使用者uuid）值。如果为空（默认），
     * 则请求将失败，并且身份验证失败4xx。请注意，此值必须引用idKong内部的Consumer 属性，而不是它的custom_id。
     * @var
     */
    protected $anonymous;

    /**
     * @param bool $hide_credentials
     * @return self
     */
    public function setHideCredentials(bool $hide_credentials): self
    {
        $this->hide_credentials = $hide_credentials;
        return $this;
    }

    /**
     * @param mixed $anonymous
     * @return self
     */
    public function setAnonymous($anonymous): self
    {
        $this->anonymous = $anonymous;
        return $this;
    }
}