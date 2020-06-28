<?php


namespace Kong\Bean;


/**
 * SNI对象表示主机名到证书的多对一映射。也就是说，证书对象可以具有许多与其关联的主机名。当Kong收到SSL请求时，
 * 它将使用客户端Hello中的SNI字段基于与证书关联的SNI查找证书对象
 * Class Sni
 * @package Kong\Bean
 */
class SNI extends Base
{
    /**
     * 与给定证书关联的SNI名称。
     * @var string
     */
    protected $name;

    /**
     * 与SNI主机名相关联的证书的ID（UUID）。证书必须具有与之关联的有效私钥，
     * SNI对象才能使用该证书。使用形式编码时，符号为certificate.id=<certificate id>。对于JSON，请使用“” "certificate":{"id":"<certificate id>"}
     * @var string
     */
    protected $certificate = '';

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $certificate
     * @return self
     */
    public function setCertificate(string $certificate): self
    {
        $this->certificate = $certificate;
        return $this;
    }
}