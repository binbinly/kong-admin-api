<?php

namespace Kong\Action;

use Kong\Service\Certificate;
use Kong\Service\Plugin;
use Kong\Service\Route;
use Kong\Service\Service;
use Kong\Service\SNI;
use Kong\Service\Target;
use Kong\Service\Upstream;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 列表操作
 * Class Lists
 * @package Kong\Action
 */
class Lists extends Action
{
    /**
     * @param string $id
     * @return array
     * @throws GuzzleException
     */
    public function service($id = ''){
        $service = new Service($this->client);
        return $this->execute($service, $id);
    }

    /**
     * @param $serviceName
     * @param string $id
     * @return array
     * @throws GuzzleException
     */
    public function route($serviceName = '', $id = ''){
        $service = new Route($this->client);
        $serviceName && $service->setRoute($serviceName);
        return $this->execute($service, $id);
    }

    /**
     * @param string $id
     * @return array
     * @throws GuzzleException
     */
    public function upstream($id = ''){
        $service = new Upstream($this->client);
        return $this->execute($service, $id);
    }

    /**
     * @param string $upstreamName
     * @param string $id
     * @return array
     * @throws GuzzleException
     */
    public function target(string $upstreamName = '', $id = ''){
        $service = new Target($this->client);
        $upstreamName && $service->setRoute($upstreamName);
        return $this->execute($service, $id);
    }

    /**
     * @param string $id
     * @return array
     * @throws GuzzleException
     */
    public function plugin($id = ''){
        $service = new Plugin($this->client);
        return $this->execute($service, $id);
    }

    /**
     * @param string $id
     * @return array
     * @throws GuzzleException
     */
    public function certificate($id = ''){
        $service = new Certificate($this->client);
        return $this->execute($service, $id);
    }

    /**
     * @param string $id
     * @return array
     * @throws GuzzleException
     */
    public function sni($id = ''){
        $service = new SNI($this->client);
        if ($id) $service->setRoute($id);
        return $this->execute($service, $id);
    }

    /**
     * 查询
     * @param \Kong\Service\Base $service
     * @param $id
     * @return array
     * @throws GuzzleException
     */
    protected function execute($service, $id){
        if ($id) {
            return $this->jsonDecode($service->find($id));
        }
        return $this->jsonDecode($service->list());
    }
}