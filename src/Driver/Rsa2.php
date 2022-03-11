<?php
namespace welld1990\ApiCrypto\Driver;

/**
 * RSA 方式
 *  
 * @author Administrator
 *
 */
class Rsa2 implements  DriverInterface
{

    /**
     * 配置数据
     * @param $pwd 
     * @param $iv
     * @var array
     */
    private $config = array(
        'out' => 'base64',/*可选方式 base64(默认) 和 hex */
        'type' => 'private',/*解密方式  private,加密方式为pulic,解密方式为public 加密方式为private */
        'public' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAuBL3YeYYhniL9ky6RQApztq5ChlQ3Wfe+dekv8HalBxsDqUWjrQnlFM2sXigLvy+VIMnzWbXg9YQi29SzlncAyZ9WrKQnzLxJuZ3RiEZDfBGKwnOFswB69UkoaubsCdj66eBW8pHgfhVBrFvWLG6pNta5wHYhtbCpz1214SB0Obroo7G2+dMf9MqKW/SxeRr2+P9kG2moKC7QDCrWcbwHjGak0poaievixNaQWxcEvH/afFnKxg3pSZN21ORgRklPUBKXhWBvAjdPbyNh5tCrNvcAaAj52e/788vVsTiJkFd/YUoxqMNkP29CoJV0s/OBrwJNewvqOB1XXG7p8bGzwIDAQAB',
        'private'     => 'MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQC4Evdh5hiGeIv2TLpFACnO2rkKGVDdZ97516S/wdqUHGwOpRaOtCeUUzaxeKAu/L5UgyfNZteD1hCLb1LOWdwDJn1aspCfMvEm5ndGIRkN8EYrCc4WzAHr1SShq5uwJ2Prp4FbykeB+FUGsW9Ysbqk21rnAdiG1sKnPXbXhIHQ5uuijsbb50x/0yopb9LF5Gvb4/2QbaagoLtAMKtZxvAeMZqTSmhqJ6+LE1pBbFwS8f9p8WcrGDelJk3bU5GBGSU9QEpeFYG8CN09vI2Hm0Ks29wBoCPnZ7/vzy9WxOImQV39hSjGow2Q/b0KglXSz84GvAk17C+o4HVdcbunxsbPAgMBAAECggEAN61M9GizvGDT/PDiWqKdArt3ws07f2y+rhWC+Jl7MteR+7AFra5iVmQBJBcXZH8AVvHA5UkZIQBryrEme9IEUVOgEQH36p9u/9Qv+Z9jQ6sMnlH96zlTz3CN/vS4R8TyXUIyR4BctrxVg4vB4TMJAHp0+XC+fLKS+CEIRFIJLhVXlf6m2lt4TN2NXHFcQlWb0PVz3f7JFistprC3bHXmCYTNjrOVhZVUytRF5PLNcjtnbwvIzwV9ELEEZE+Bc/wh3hLsoy0yYWn0kKS3m8Kw2jt6ZMboTKqFDRmhOXZqzA9W3BMfAoWXboZC/0WVwX04JZnomBpMkcdyu/LqCUqqAQKBgQDbtCRLYoD6pHOz2v9w1vUOEbuEYtOQA7q0T1U7hveGrfT6PM/BGznTAkYUJCLKkM+jjto7UHvy3gIz3PpfufU7WwW0OJr4w4/QNYei8G89VTKUsmVATSaFvCrSIwahH0t4JJkNNAXBjXhuHE1h496jCZOGh7h3bVlXgHx5vAEDzwKBgQDWe/QZVqFXrUvuy/t/yD7aFRikho9eUEmcjfsJX0MKPeYjaU5rUbvDF1YG4heZEBBwJroJCh5GlWTkNtY70aHN1Mmq7JflGy6gSTausBe5f27YoXbf/ffnVeuyy/6QVzH9NDazFnl5KR5CKg6cJ2qk+sgDKiRRMDpBz7ZnYffNAQKBgDGZ/ge2+X+c2TJl4v3KyhCfGELPPQxqiyBiOM/zrLaPV5uXVyA10Vw+SywI7IHnJ7m5arOxfApc7QpgfXZXOXJpHmSN0w8Ot80+CJ1UwwiJz52amRlnUacn0FMY7Uo7EoLRYGyGrjYAhov1f9L16zHL266nvZHY8i67J18kfuYpAoGANz1/ddMxBLLWXq9cm+GIBoTubtlVLXZCLzcGE7jcPFQK5M3na46GbE2jU2yBpWNUyH3A5jkb6RPrAzf4XzmzkZ6fPg1nZZNlo9SXZ9Bkm9rtQo/7XN89LPCdHtSZQLWkY1FCUUeVi5YCfAn271LbjZglUWNWLS7dojuL//5kYwECgYB3nbWY46JWQGhM+diDmtSPlY2SWSQnA1rMobPIQmTKnIA9NZWObYtqwy/HtJNo3Yu1ggnUVsk6GWNQZuvKgPm+busfhnPlbJQH33uBrWrOzPZz+OtJvbY4QEZ/gxWB9yeA7SGmsnCBxIAmTDfDMwyC8oQjnZ2bAy2A8QAijvdEXg==',
    );

    /**
     * 初始化
     * @param array $config
     */
    public function __construct($config=array())
    {
        $this->config = array_merge($this->config, $config);
        
        $this->config['public'] = "-----BEGIN PUBLIC KEY-----\n" .wordwrap($this->config['public'], 64, "\n", true) ."\n-----END PUBLIC KEY-----";
        $this->config['public'] = openssl_pkey_get_public($this->config['public']);
        
        $this->config['private'] = "-----BEGIN PRIVATE KEY-----\n" .wordwrap($this->config['private'], 64, "\n", true) ."\n-----END PRIVATE KEY-----";
        $this->config['private'] = openssl_pkey_get_private($this->config['private']);
    }

    /**
     * 加密
     * @param string $str 要加密的数据
     * @return bool|string 加密后的数据
     */
    public function encrypt($data)
    {
        if ($this->config['type'] == 'private'){
            $data = $this->publicEncrypt($data);
        }else{
            $data = $this->privateEncrypt($data);
        }
        
        
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
        if ($this->config['type'] == 'private'){
            $data = $this->privateDecrypt($data);
        }else{
            $data = $this->publicDecrypt($data);
        }
        return $data;
    }
    
    /**
     * 公钥加密
     */
    private function publicEncrypt($data){
        openssl_public_encrypt($data,$encrypted,$this->config['public']);
        return $encrypted;
    }
    /**
     * 私钥解密
     */
    private function privateDecrypt($data){
        
        openssl_private_decrypt($data,$encrypted,$this->config['private']);
        return $encrypted;
    }
    
    /**
     * 私钥加密
     */
    private function privateEncrypt($data){
        
        openssl_private_encrypt($data,$encrypted,$this->config['private']);
        return $encrypted;
    }
    
    /**
     * 公钥解密
     */
    private function publicDecrypt($data){
        openssl_public_decrypt($data,$encrypted,$this->config['public']);
        
        return $encrypted;
    }
}

