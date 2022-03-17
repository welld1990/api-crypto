<?php
namespace welld1990\ApiCrypto\Driver;

/**
 * RSA 方式
 *  
 * @author Administrator
 *
 */
class Rsa implements  DriverInterface
{
    //密文输出方式 base64 / hex
    private $out = 'base64';
    //解密方式 公钥解密 pubway/ 私钥解密priway
    private $way = 'private';
    //公钥
    private $public_key = "";
    //私钥
    private $private_key = "";

    /**
     * 初始化
     * @param array $config
     */
    public function __construct($config=array())
    {
        if (isset($config['out'])){
            $this->out = $config['out'];
        }
        if (isset($config['way'])){
            $this->way = $config['way'];
        }
        if (isset($config['public_key'])){
            $this->public_key = $config['public_key'];
        }
        if (isset($config['private_key'])){
            $this->private_key = $config['private_key'];
        }
    }

    /**
     * 加密
     * @param string $str 要加密的数据
     * @return bool|string 加密后的数据
     */
    public function encrypt($data)
    {
        if ($this->way == 'public'){
            $data = $this->publicEncrypt($data);
        }else{
            $data = $this->privateEncrypt($data);
        }
        
        
        if ($this->out == 'hex'){
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
        if ($this->out == 'hex'){
            $data = hex2bin($data);
        }else{
            $data = base64_decode($data);
        }
        if ($this->way == 'public'){
            $data = $this->publicDecrypt($data);
        }else{
            $data = $this->privateDecrypt($data);
        }
        return $data;
    }
    
    /**
     * 公钥加密
     */
    private function publicEncrypt($data){
        openssl_public_encrypt($data,$encrypted,$this->public_key);
        return $encrypted;
    }
    /**
     * 私钥解密
     */
    private function privateDecrypt($data){
        
        openssl_private_decrypt($data,$encrypted,$this->private_key);
        return $encrypted;
    }
    
    /**
     * 私钥加密
     */
    private function privateEncrypt($data){
        
        openssl_private_encrypt($data,$encrypted,$this->private_key);
        return $encrypted;
    }
    
    /**
     * 公钥解密
     */
    private function publicDecrypt($data){
        openssl_public_decrypt($data,$encrypted,$this->public_key);
        
        return $encrypted;
    }
}

