<?php

namespace Kong\Bean\Plugin;

use Kong\Bean\ArrayAble;

abstract class PluginConfig implements ArrayAble
{
    protected $name;

    /**
     * @return array
     */
    public function toArray()
    {
        $list = get_object_vars($this);
        unset($list['name']);
        return array_filter($list, function ($value) {
            return ! is_null($value);
        });
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}