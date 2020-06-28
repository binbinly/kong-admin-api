<?php


namespace Kong\Bean\Plugin\Log;


use Kong\Bean\Plugin\PluginConfig;

class Syslog extends PluginConfig
{
    protected $name = 'syslog';

    /**
     * 分配给所有成功请求的可选日志记录严重性，响应状态代码小于400。
     * 默认值：info
     * @var
     */
    protected $successful_severity;

    /**
     * 可选的日志记录严重性，分配给所有响应状态代码为400或更高但小于500的失败请求。
     * 默认值：info
     * @var
     */
    protected $client_errors_severity;

    /**
     * 可选的日志记录严重性，分配给所有响应状态代码为500或更高的失败请求。
     * 默认值：info
     * @var
     */
    protected $server_errors_severity;

    /**
     * 可选的日志记录严重性，具有相同或更高严重性的任何请求都将记录到系统日志中。
     * 默认值：info
     * @var
     */
    protected $log_level;

    /**
     * @param mixed $successful_severity
     * @return self
     */
    public function setSuccessfulSeverity($successful_severity): self
    {
        $this->successful_severity = $successful_severity;
        return $this;
    }

    /**
     * @param mixed $client_errors_severity
     * @return self
     */
    public function setClientErrorsSeverity($client_errors_severity): self
    {
        $this->client_errors_severity = $client_errors_severity;
        return $this;
    }

    /**
     * @param mixed $server_errors_severity
     * @return self
     */
    public function setServerErrorsSeverity($server_errors_severity): self
    {
        $this->server_errors_severity = $server_errors_severity;
        return $this;
    }

    /**
     * @param mixed $log_level
     * @return self
     */
    public function setLogLevel($log_level): self
    {
        $this->log_level = $log_level;
        return $this;
    }
}