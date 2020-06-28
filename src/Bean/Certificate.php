<?php

namespace Kong\Bean;


/**
 * 证书对象代表公共证书，可以选择与相应的私钥配对。Kong使用这些对象来处理SSL / TLS终止以进行加密请求，
 * 或在验证客户端/服务的对等证书时用作受信任的CA存储。证书可以选择与SNI对象关联，以将证书/密钥对绑定到一个或多个主机名。
 *
 * 如果除了主证书外还需要中间证书，则应按照以下顺序将它们串联在一起：一串是主证书，其次是中间证书
 * Class Certificate
 * @package Kong\Model
 */
class Certificate extends Base
{
    /**
     * @var string PEM-encoded public certificate chain of the SSL key pair.
     */
    protected $cert;

    /**
     * @var string PEM-encoded private key of the SSL key pair.
     */
    protected $key;

    /**
     * @param string $cert
     * @return self
     */
    public function setCert(string $cert): self
    {
        $this->cert = $cert;
        return $this;
    }

    /**
     * @param string $key
     * @return self
     */
    public function setKey(string $key): self
    {
        $this->key = $key;
        return $this;
    }
}
