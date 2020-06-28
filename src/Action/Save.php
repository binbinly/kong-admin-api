<?php

namespace Kong\Action;

use GuzzleHttp\Exception\GuzzleException;
use Kong\Bean\Certificate;
use Kong\Bean\Route;
use Kong\Bean\Service;
use Kong\Bean\SNI;
use Kong\Bean\Target;
use Kong\Bean\Upstream;

class Save extends Action
{
    /**
     * 添加服务
     * @param $serviceName
     * @param $upstreamName
     * @return string
     * @throws GuzzleException
     */
    public function service(string $serviceName, string $upstreamName){
        $bean = new Service();
        $bean->setName($serviceName)
            ->setRetries(3)
            ->setProtocol('http')
            ->setHost($upstreamName)
            ->setConnectTimeout(15000)
            ->setWriteTimeout(15000)
            ->setReadTimeout(15000);
        $service = new \Kong\Service\Service($this->client);
        return $service->add($bean);
    }

    /**
     * 添加路由
     * @param string $routeName
     * @param string $serviceName
     * @param array $host
     * @return string
     * @throws GuzzleException
     */
    public function route(string $routeName,string $serviceName, array $host){
        $bean = new Route();
        $bean->setName($routeName)
            ->setHosts($host)
            ->setPreserveHost(true)
            ->setProtocols(['https']);
        $service = new \Kong\Service\Route($this->client);
        return $service->setRoute($serviceName)->add($bean);
    }

    /**
     * 添加上游
     * @param string $upstreamName
     * @return string
     * @throws GuzzleException
     */
    public function upstream(string $upstreamName){
        $bean = new Upstream();
        $bean->setName($upstreamName)->setHashOn('ip');
        $service = new \Kong\Service\Upstream($this->client);
        return $service->add($bean);
    }

    /**
     * 添加上游目标
     * @param string $target
     * @param string $upstreamName
     * @return string
     * @throws GuzzleException
     */
    public function target(string $target, string $upstreamName){
        $bean = new Target();
        $bean->setTarget($target);
        $service = new \Kong\Service\Target($this->client);
        return $service->setRoute($upstreamName)->add($bean);
    }

    /**
     * 添加证书
     * @param string $cert
     * @param string $key
     * @param array $tags
     * @return string
     * @throws GuzzleException
     */
    public function certificate(string $cert, string $key, array $tags){
        $bean = new Certificate();
        $bean->setCert($cert)->setKey($key)->setTags($tags);
        $service = new \Kong\Service\Certificate($this->client);
        return $service->add($bean);
    }

    /**
     * 添加SNI对象映射-映射路由hosts
     * @param string $name
     * @param string $id
     * @return string
     * @throws GuzzleException
     */
    public function sni(string $name, string $id){
        $bean = new SNI();
        $bean->setName($name);
        $service = new \Kong\Service\SNI($this->client);
        return $service->setRoute($id)->add($bean);
    }
}