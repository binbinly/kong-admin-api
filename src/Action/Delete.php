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

class Delete extends Action
{
    /**
     * @param string $id
     * @return string
     * @throws GuzzleException
     */
    public function service($id){
        $service = new Service($this->client);
        return $service->del($id);
    }

    /**
     * @param $serviceName
     * @param string $id
     * @return string
     * @throws GuzzleException
     */
    public function route($id, $serviceName = ''){
        $service = new Route($this->client);
        $serviceName && $service->setRoute($serviceName);
        return $service->del($id);
    }

    /**
     * @param string $id
     * @return string
     * @throws GuzzleException
     */
    public function upstream($id){
        $service = new Upstream($this->client);
        return $service->del($id);
    }

    /**
     * @param string $upstreamName
     * @param string $id
     * @return string
     * @throws GuzzleException
     */
    public function target($id, string $upstreamName = ''){
        $service = new Target($this->client);
        $upstreamName && $service->setRoute($upstreamName);
        return $service->del($id);
    }

    /**
     * @param string $id
     * @return string
     * @throws GuzzleException
     */
    public function plugin($id){
        $service = new Plugin($this->client);
        return $service->del($id);
    }

    /**
     * @param string $id
     * @return string
     * @throws GuzzleException
     */
    public function certificate($id){
        $service = new Certificate($this->client);
        return $service->del($id);
    }

    /**
     * @param string $id
     * @param string $certificateId
     * @return string
     * @throws GuzzleException
     */
    public function sni($id, $certificateId = ''){
        $service = new SNI($this->client);
        if ($id) $service->setRoute($certificateId);
        return $service->del($id);
    }
}