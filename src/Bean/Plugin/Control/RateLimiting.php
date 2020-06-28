<?php


namespace Kong\Bean\Plugin\Control;


use Kong\Bean\Plugin\PluginConfig;


/**
 * 限流 - 速率限制在给定的几秒钟，几分钟，几小时，几天，几月或几年内，开发人员可以发出多少个HTTP请求。
 * 如果基础服务/路由（或不建议使用的API实体）没有身份验证层，则将使用客户端IP地址，否则，如果已配置身份验证插件，则将使用使用者。
 * https://docs.konghq.com/hub/kong-inc/rate-limiting/
 * Class RateLimiting
 * @package Kong\Bean\Plugin\Control
 */
class RateLimiting extends PluginConfig
{
    const POLICY_LOCAL = 'local';
    const POLICY_REDIS = 'redis';

    protected $name = 'rate-limiting';

    /**
     * 开发人员每秒可以发出的HTTP请求数量。至少必须存在一个限制。
     * @var
     */
    protected $second;

    /**
     * 开发人员每分钟可以发出的HTTP请求数量。至少必须存在一个限制。
     * @var
     */
    protected $minute;

    /**
     * 开发人员每小时可发出的HTTP请求数量。至少必须存在一个限制。
     * @var
     */
    protected $hour;

    /**
     * 开发人员每天可以发出的HTTP请求数量。至少必须存在一个限制。
     * @var
     */
    protected $day;

    /**
     * 开发人员每月可发出的HTTP请求数量。至少必须存在一个限制。
     * @var
     */
    protected $month;

    /**
     * 开发人员每年可以发出的HTTP请求数量。至少必须存在一个限制。
     * @var
     */
    protected $year;

    /**
     * 聚集的限制时将使用的实体：consumer，credential，ip，service。如果consumer中，credential或service无法确定，系统将始终回退到ip。
     * @var
     */
    protected $limit_by;

    /**
     * 用于检索和增加限制的速率限制策略。可用值为local（计数器将存储在本地内存中的节点上），
     * cluster（计数器存储在数据存储区中并在节点之间共享）和redis（计数器存储在Redis服务器上并将在节点之间共享）。
     * 在无DB模式下，必须至少指定local或之一redis。请参阅实施注意事项，以了解有关应使用哪种策略的详细信息。
     * @var
     */
    protected $policy;

    /**
     * 一个布尔值，该值确定即使Kong在连接第三方数据存储时遇到问题，是否也应代理请求。如果true仍然可以代理请求，
     * 则有效禁用速率限制功能，直到数据存储再次工作为止。如果是false这样，客户端将看到500错误。
     * @var bool
     */
    protected $fault_tolerant = true;

    /**
     * （可选）隐藏信息丰富的响应头。
     * @var bool
     */
    protected $hide_client_headers = false;

    /**
     * 使用redis策略时，此属性指定Redis服务器的地址。
     * @var
     */
    protected $redis_host;

    /**
     * 使用redis策略时，此属性指定Redis服务器的端口。默认为6379。
     * @var
     */
    protected $redis_port;

    /**
     * 使用redis策略时，此属性指定用于连接到Redis服务器的密码。
     * @var
     */
    protected $redis_password;

    /**
     * 使用redis策略时，此属性指定提交给Redis服务器的任何命令的超时（以毫秒为单位）。
     * @var
     */
    protected $redis_timeout;

    /**
     * 使用redis策略时，此属性指定要使用的Redis数据库。
     * @var
     */
    protected $redis_database;

    /**
     * @param mixed $second
     * @return self
     */
    public function setSecond($second): self
    {
        $this->second = $second;
        return $this;
    }

    /**
     * @param mixed $minute
     * @return self
     */
    public function setMinute($minute): self
    {
        $this->minute = $minute;
        return $this;
    }

    /**
     * @param mixed $hour
     * @return self
     */
    public function setHour($hour): self
    {
        $this->hour = $hour;
        return $this;
    }

    /**
     * @param mixed $day
     * @return self
     */
    public function setDay($day): self
    {
        $this->day = $day;
        return $this;
    }

    /**
     * @param mixed $month
     * @return self
     */
    public function setMonth($month): self
    {
        $this->month = $month;
        return $this;
    }

    /**
     * @param mixed $year
     * @return self
     */
    public function setYear($year): self
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @param mixed $limit_by
     * @return self
     */
    public function setLimitBy($limit_by): self
    {
        $this->limit_by = $limit_by;
        return $this;
    }

    /**
     * @param mixed $policy
     * @return self
     */
    public function setPolicy($policy): self
    {
        $this->policy = $policy;
        return $this;
    }

    /**
     * @param bool $fault_tolerant
     * @return self
     */
    public function setFaultTolerant(bool $fault_tolerant): self
    {
        $this->fault_tolerant = $fault_tolerant;
        return $this;
    }

    /**
     * @param bool $hide_client_headers
     * @return self
     */
    public function setHideClientHeaders(bool $hide_client_headers): self
    {
        $this->hide_client_headers = $hide_client_headers;
        return $this;
    }

    /**
     * @param mixed $redis_host
     * @return self
     */
    public function setRedisHost($redis_host): self
    {
        $this->redis_host = $redis_host;
        return $this;
    }

    /**
     * @param mixed $redis_port
     * @return self
     */
    public function setRedisPort($redis_port): self
    {
        $this->redis_port = $redis_port;
        return $this;
    }

    /**
     * @param mixed $redis_password
     * @return self
     */
    public function setRedisPassword($redis_password): self
    {
        $this->redis_password = $redis_password;
        return $this;
    }

    /**
     * @param mixed $redis_timeout
     * @return self
     */
    public function setRedisTimeout($redis_timeout): self
    {
        $this->redis_timeout = $redis_timeout;
        return $this;
    }

    /**
     * @param mixed $redis_database
     * @return self
     */
    public function setRedisDatabase($redis_database): self
    {
        $this->redis_database = $redis_database;
        return $this;
    }
}