<?php
namespace welld1990\ApiCrypto;

class CryptoClient
{

    private static $instance = null;

    /**
     * 驱动对象
     * 
     * @var unknown
     */
    private $cryptoClient;
    
    /**
     * 配置信息
     * @var array
     */
    private $config = array(
        'driver'        =>  '', // 驱动
        'driverConfig'  =>  array(), //驱动配置
    );
    
    /**
     * 构造器私有化:禁止从类外部实例化
     */
    private function __construct($config = array())
    {
        /* 获取配置 */
        $this->config   =   array_merge($this->config, $config);
        //设置驱动
        if(!$this->config['driver'] || empty($this->config['driverConfig'])){
            throw new \Exception("请配置驱动");
        }
        
        $class = __NAMESPACE__  . '\\Driver\\' . ucfirst($this->config['driver']);
        $this->cryptoClient = new $class($this->config['driverConfig']);
        if(!$this->cryptoClient){
            throw new \Exception("不存在上传驱动：{$this->config['driver']}");
        }
    }
    
    /**
     * 唯一实例
     */
    public static function getInstance($config = array())
    {
        // 检测当前类属性$instance是否已经保存了当前类的实例
        if (self::$instance === null) {
            // 如果没有,则创建当前类的实例
            self::$instance = new self($config);
        }
        // 如果已经有了当前类实例,就直接返回,不要重复创建类实例
        return self::$instance;
    }
    
    /**
     * 加密
     */
    public function encrypt($data)
    {
        return $this->cryptoClient->encrypt($data);
    }
    /**
     * 解密
     */
    public function decrypt($data){
        return $this->cryptoClient->decrypt($data);
    }
}