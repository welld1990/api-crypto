<?php
namespace welld1990\ApiCrypto\Driver;

/**
 * AES CBC 方式
 *  
 * @author Administrator
 *
 */
class Aes implements  DriverInterface
{

    /**
     * 配置数据
     * @param $pwd 
     * @param $iv
     * @var array
     */
    private $config = array(
        'out' => 'base64',/*可选方式 base64(默认) 和 hex */
        'pwd' => '6b07cb0ae7337a30',
        'iv'     => '1111111111110001'
    );

    /**
     * 初始化
     * @param array $config
     */
    public function __construct($config=array())
    {
        $this->config = array_merge($this->config, $config);
    }

    /**
     * 加密
     * @param string $str 要加密的数据
     * @return bool|string 加密后的数据
     */
    public function encrypt($data)
    {
        $data = openssl_encrypt($data, 'AES-128-CBC', $this->config['pwd'], OPENSSL_RAW_DATA, $this->config['iv']);
        
        if ($this->config['out'] == 'hex'){
            $data = bin2hex($data);
        }else{
            $data = base64_encode($data);
        }
        
        return $data;
    }

    /**
     * 解密
     * @param string $str 要解密的数据
     * @return string 解密后的数据
     */
    public function decrypt($data)
    {
        if ($this->config['out'] == 'hex'){
            $data = hex2bin($data);
        }else{
            $data = base64_decode($data);
        }
        $data = openssl_decrypt($data, 'AES-128-CBC', $this->config['pwd'], OPENSSL_RAW_DATA, $this->config['iv']);
        return $data;
    }
}

