<?php


namespace Kong\Bean;


abstract class Base implements ArrayAble
{
    /** @var int */
    const DEFAULT_PORT = 80;

    /**
     * @var string
     */
    protected $id;

    /**
     * 与其关联的一组可选字符串，用于分组和过滤。
     * @var array
     */
    protected $tags;

    /**
     * @param mixed $id
     * @return $this
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param array $tags
     * @return self
     */
    public function setTags(array $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * 获取或有属性
     * @return array
     */
    public function toArray()
    {
        return array_filter(get_object_vars($this), function ($value) {
            return ! is_null($value);
        });
    }
}