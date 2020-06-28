<?php


namespace Kong\Bean;


/**
 * 目标是带有端口的ip地址/主机名，该端口标识后端服务的实例。每个上游都可以有许多目标，并且可以动态添加目标。更改是即时进行的。
 *
 * 由于上游保留了目标更改的历史记录，因此无法删除或修改目标。要禁用目标，请使用张贴一个新目标weight=0；或者，使用DELETE便捷方法来完成此操作
 * Class Target
 * @package Kong\Bean
 */
class Target extends Base
{
    /**
     * 目标地址（IP或主机名）和端口。如果主机名解析为SRV记录，则该port值将被DNS记录中的值覆盖。
     * @var string
     */
    protected $target;

    /**
     * 此目标的重量在上游负载均衡器（0- 1000）内。如果主机名解析为SRV记录，则该weight值将被DNS记录中的值覆盖。默认为100。
     * @var int
     */
    protected $weight;

    /**
     * @param string $target
     * @return self
     */
    public function setTarget(string $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * @param int $weight
     * @return self
     */
    public function setWeight(int $weight): self
    {
        $this->weight = $weight;
        return $this;
    }
}