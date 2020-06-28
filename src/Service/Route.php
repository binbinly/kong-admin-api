<?php

namespace Kong\Service;

class Route extends Base
{
    protected $route = 'routes';

    /**
     * @param $id
     * @return Route
     */
    public function setRoute($id): self
    {
        $this->route = 'services/' . $id . '/routes';
        return $this;
    }
}