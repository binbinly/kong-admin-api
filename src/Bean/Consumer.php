<?php

namespace Kong\Bean;


/**
 * 消费者对象代表服务的消费者或用户。您可以依靠Kong作为主要数据存储，也可以将使用者列表与数据库映射，以保持Kong和现有主要数据存储之间的一致性。
 * Class Consumer
 * @package Kong\Bean
 */
class Consumer extends Base
{
    /**
     * 使用者的唯一用户名。您必须发送此字段或custom_id与请求一起发送
     * @var string
     */
    public $username;

    /**
     * 用于为消费者存储现有唯一ID的字段-在将Kong与用户映射到现有数据库中时非常有用。您必须发送此字段或username与请求一起发送
     * @var
     */
    public $custom_id;

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param mixed $custom_id
     */
    public function setCustomId($custom_id): void
    {
        $this->custom_id = $custom_id;
    }
}
