<?php


namespace Kong\Action;


use Kong\Bean\Plugin as PluginBean;
use Kong\Bean\Plugin\Security\BotDetection;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 插件管理器
 * Class PluginManage
 * @package Kong
 */
class Plugin extends Action
{
    /**
     * 机器人检测
     * @throws GuzzleException
     */
    public function botDetection(){
        $bean = new BotDetection();
        $this->addPlugin($bean);
    }

    /**
     * 监控 分析
     * @throws GuzzleException
     */
    public function prometheus(){
        $bean = new PluginBean\Analytics\Prometheus();
        $this->addPlugin($bean);
    }

    /**
     * 限流
     * @throws GuzzleException
     */
    public function rateLimiting(){
        $bean = new PluginBean\Control\RateLimiting();
        $bean->setPolicy(PluginBean\Control\RateLimiting::POLICY_LOCAL)
            ->setDay(65535);
        $this->addPlugin($bean);
    }

    /**
     * @param PluginBean\PluginConfig $bean
     * @throws GuzzleException
     */
    protected function addPlugin(PluginBean\PluginConfig $bean){
        $plugin = new PluginBean();
        $plugin->setName($bean->getName())
            ->setConfig($bean->toArray());
        $service = new \Kong\Service\Plugin($this->client);
        $service->add($plugin);
    }
}