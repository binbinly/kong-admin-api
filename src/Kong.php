<?php

namespace Kong;


use GuzzleHttp\Exception\GuzzleException;
use Kong\Action\Delete;
use Kong\Action\Lists;
use Kong\Action\Plugin;
use Kong\Action\Save;
use Kong\Http\HttpClient;

class Kong
{
    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * 错误信息
     * @var string
     */
    protected $err;

    public function __construct(array $config)
    {
        $this->client = new HttpClient($config);
    }

    /**
     * @return mixed
     */
    public function getErr()
    {
        return $this->err;
    }

    /**
     * 获取更新操作类
     * @return Save
     */
    public function getSaveAction()
    {
        return new Save($this->client);
    }

    /**
     * 获取详情，列表操作类
     * @return Lists
     */
    public function getListsAction()
    {
        return new Lists($this->client);
    }

    /**
     * 获取删除操作类
     * @return Delete
     */
    public function getDeleteAction()
    {
        return new Delete($this->client);
    }

    /**
     * 获取插件操作类
     * @return Plugin
     */
    public function getPluginAction()
    {
        return new Plugin($this->client);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function createProject(array $data)
    {
        $action = new Save($this->client);
        try {
            //add service
            $action->service($data['service_name'], $data['upstream_name']);
            //add route
            $action->route($data['route_name'], $data['service_name'], $data['host']);
            //add upstream
            $action->upstream($data['upstream_name']);
            //add target
            $action->target($data['target'], $data['upstream_name']);
        } catch (GuzzleException $e) {
            $this->err = $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * 服务详情
     * @param $name
     * @return array|bool
     */
    public function serviceDetail(string $name)
    {
        $action = new Lists($this->client);
        try {
            $s = $action->service($name);
            $r = $action->route($name);
            return [$s, $r];
        } catch (GuzzleException $e) {
            $this->err = $e->getMessage();
            return false;
        }
    }

    /**
     * 上游详情
     * @param $name
     * @return array|bool
     */
    public function upstreamDetail(string $name)
    {
        $action = new Lists($this->client);
        try {
            $u = $action->upstream($name);
            $t = $action->target($name);
            return [$u, $t];
        } catch (GuzzleException $e) {
            $this->err = $e->getMessage();
            return false;
        }
    }

    /**
     * 删除服务且对应的路由
     * @param string $name
     * @return bool
     */
    public function deleteService(string $name)
    {
        $action = new Delete($this->client);
        $actionList = new Lists($this->client);
        try {
            //查找路由
            $r = $actionList->route($name);
            if (isset($r['data']) && $r['data']) {
                foreach ($r['data'] as $item) {
                    $action->route($item['id'], $name);
                }
            }
            $action->service($name);
        } catch (GuzzleException $e) {
            $this->err = $e->getMessage();
            return false;
        }
    }

    /**
     * 删除上游，包括其目标
     * @param string $name
     * @return bool
     */
    public function deleteUpstream(string $name)
    {
        $action = new Delete($this->client);
        $actionList = new Lists($this->client);
        try {
            //查找路由
            $t = $actionList->target($name);
            if (isset($t['data']) && $t['data']) {
                foreach ($t['data'] as $item) {
                    $action->target($item['id'], $name);
                }
            }
            $action->upstream($name);
        } catch (GuzzleException $e) {
            $this->err = $e->getMessage();
            return false;
        }
    }

    /**
     * 初始化所有证书
     * @param array $cert
     * @return bool
     * @throws GuzzleException
     */
    public function initCertificate(array $cert)
    {
        if (!$cert) {
            $this->err = 'empty';
            return false;
        }
        $action = new Save($this->client);
        try {
            foreach ($cert as $item) {
                $action->certificate($item['crt'], $item['key'], $item['tags']);
            }
            return true;
        } catch (GuzzleException $e) {
            $this->err = $e->getMessage();
            return false;
        }
    }

    /**
     * 添加sni
     * @param string $name
     * @param string $keyword
     * @return bool
     */
    public function addSni(string $name, string $keyword)
    {
        $action = new Lists($this->client);
        try {
            $list = $action->certificate();
            $id = 0;
            if ($list['data']) {
                foreach ($list['data'] as $item) {
                    if (!$item['tags'] || in_array($keyword, $item['tags'])) {
                        $id = $item['id'];
                    }
                }
            }
            if (!$id) {
                $this->err = 'id empty';
                return false;
            }
            $actionSave = new Save($this->client);
            $actionSave->sni($name, $id);
            return true;
        } catch (GuzzleException $e) {
            $this->err = $e->getMessage();
            return false;
        }
    }

    /**
     * 初始化全局插件
     * @throws GuzzleException
     */
    public function initPlugin()
    {
        $plugin = new Plugin($this->client);
        $plugin->prometheus();
        $plugin->botDetection();
    }
}
