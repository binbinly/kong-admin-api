<?php

namespace Kong\Service;

class Target extends Base
{
    /**
     * @param $id
     * @return self
     */
    public function setRoute($id): self
    {
        $this->route = '/upstreams/' . $id . '/targets';
        return $this;
    }
}