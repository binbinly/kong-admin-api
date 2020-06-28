<?php


namespace Kong\Bean;


/**
 * 上游对象代表虚拟主机名，可用于对多个服务（目标）上的传入请求进行负载平衡。因此，例如，上游命名service.v1.xyz为服务对象，
 * 其host是service.v1.xyz。对该服务的请求将被代理到上游定义的目标。
 *
 * 上游还包括一个运行状况检查器，该检查器能够根据目标是否能够满足请求来启用和禁用它们。健康状况检查器的配置存储在上游对象中，并应用于其所有目标。
 * Class Upstream
 * @package Kong\Bean
 */
class Upstream extends Base
{
    /**
     * 这是一个主机名，必须host与服务的主机名相同
     * @var string
     */
    protected $name;

    /**
     * 使用哪种负载均衡算法。可接受的值是："consistent-hashing"，"least-connections"，"round-robin"。默认为"round-robin"。
     * @var string
     */
    protected $algorithm;

    /**
     * 用作哈希输入的内容。使用的none结果是没有哈希的加权循环方案。可接受的值是："none"，"consumer"，"ip"，"header"，"cookie"。默认为"none"。
     * @var string
     */
    protected $hash_on;

    /**
     * 如果主数据库hash_on不返回哈希值（例如，标头丢失或未标识使用者），则用作哈希输入的内容。
     * 如果hash_on设置为，则不可用cookie。可接受的值是："none"，"consumer"，"ip"，"header"，"cookie"。默认为"none"。
     * @var string
     */
    protected $hash_fallback;

    /**
     * 将从中获取值的标头名称作为哈希输入。仅当hash_on设置为header时才需要。
     * @var string
     */
    protected $hash_on_header;

    /**
     * 将从中获取值的标头名称作为哈希输入。仅当hash_fallback设置为header时才需要。
     * @var string
     */
    protected $hash_fallback_header;

    /**
     * 从中获取值的cookie名称作为哈希输入。仅在hash_on或hash_fallback设置为cookie时才需要。如果请求中没有指定的cookie，则Kong将生成一个值并在响应中设置cookie。
     * @var string
     */
    protected $hash_on_cookie;

    /**
     * 在响应标题中设置的cookie路径。仅在hash_on或hash_fallback设置为cookie时才需要。默认为"/"。
     * @var string
     */
    protected $hash_on_cookie_path;

    /**
     * 负载均衡器算法中的插槽数（10- 65536）。默认为10000。
     * @var int
     */
    protected $slots;

    /**
     * Host通过Kong代理请求时用作标题的主机名。
     * @var string
     */
    protected $host_header;

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
     * @param string $algorithm
     * @return self
     */
    public function setAlgorithm(string $algorithm): self
    {
        $this->algorithm = $algorithm;
        return $this;
    }

    /**
     * @param string $hash_on
     * @return self
     */
    public function setHashOn(string $hash_on): self
    {
        $this->hash_on = $hash_on;
        return $this;
    }

    /**
     * @param string $hash_fallback
     * @return self
     */
    public function setHashFallback(string $hash_fallback): self
    {
        $this->hash_fallback = $hash_fallback;
        return $this;
    }

    /**
     * @param string $hash_on_header
     * @return self
     */
    public function setHashOnHeader(string $hash_on_header): self
    {
        $this->hash_on_header = $hash_on_header;
        return $this;
    }

    /**
     * @param string $hash_fallback_header
     * @return self
     */
    public function setHashFallbackHeader(string $hash_fallback_header): self
    {
        $this->hash_fallback_header = $hash_fallback_header;
        return $this;
    }

    /**
     * @param string $hash_on_cookie
     * @return self
     */
    public function setHashOnCookie(string $hash_on_cookie): self
    {
        $this->hash_on_cookie = $hash_on_cookie;
        return $this;
    }

    /**
     * @param string $hash_on_cookie_path
     * @return self
     */
    public function setHashOnCookiePath(string $hash_on_cookie_path): self
    {
        $this->hash_on_cookie_path = $hash_on_cookie_path;
        return $this;
    }

    /**
     * @param int $slots
     * @return self
     */
    public function setSlots(int $slots): self
    {
        $this->slots = $slots;
        return $this;
    }

    /**
     * @param string $host_header
     * @return self
     */
    public function setHostHeader(string $host_header): self
    {
        $this->host_header = $host_header;
        return $this;
    }
}