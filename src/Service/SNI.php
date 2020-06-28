<?php

namespace Kong\Service;

class SNI extends Base
{
    protected $route = 'snis';

    /**
     * @param $id
     * @return self
     */
    public function setRoute($id): self
    {
        $this->route = 'certificates/' . $id . '/snis';
        return $this;
    }
}