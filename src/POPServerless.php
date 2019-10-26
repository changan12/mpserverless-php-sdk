<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<657306123@qq.com>
 * @date: 2019/10/21 11:45
 */
namespace duoguan\aliyun\serverless;

use duoguan\aliyun\serverless\providers\POPCloudFuncServiceProvider;
use duoguan\aliyun\serverless\providers\POPDbServiceProvider;
use duoguan\aliyun\serverless\providers\POPOpenPlatformConfigServiceProvider;
use GuzzleHttp\Client;
use xin\container\ProviderContainer;

/**
 * Class POPServerless
 *
 * @property-read \duoguan\aliyun\serverless\kernel\POPDbService                 db
 * @property-read \duoguan\aliyun\serverless\kernel\POPCloudFuncService          func
 * @property-read \duoguan\aliyun\serverless\kernel\POPOpenPlatformConfigService config
 * @package duoguan\aliyun\serverless
 */
class POPServerless extends ProviderContainer{

	/**
	 * 网关地址
	 */
	const GATEWAY_URL = "http://39.98.106.113/server";

	//	const GATEWAY_URL = "https://api.bspapp.com/server";

	/**
	 * @var array
	 */
	protected $providers
		= [
			POPDbServiceProvider::class,
			POPCloudFuncServiceProvider::class,
			POPOpenPlatformConfigServiceProvider::class,
		];

	/**
	 * @var \GuzzleHttp\Client
	 */
	protected $httpClient;

	/**
	 * @var array
	 */
	protected $config;

	/**
	 * Serverless constructor.
	 *
	 * @param array $config
	 */
	public function __construct($config){
		parent::__construct();

		$clientConfig = isset($config['client']) ? $config['client'] : [];
		$this->httpClient = new Client(array_merge([
			'base_uri' => self::GATEWAY_URL,
			'timeout'  => 2.0,
		], $clientConfig));

		if(!isset($config['ak']) || empty($config['ak'])){
			throw new \InvalidArgumentException("ak 必须配置！");
		}

		if(!isset($config['sk']) || empty($config['sk'])){
			throw new \InvalidArgumentException("ak 必须配置！");
		}

		$this->config = $config;

		$this->registerProviders();
	}

	/**
	 * 获取 ak
	 *
	 * @return string
	 */
	public function getAccessKeyId(){
		return $this->config['ak'];
	}

	/**
	 * 获取 sk
	 *
	 * @return string
	 */
	public function getAccessKeySecret(){
		return $this->config['sk'];
	}

	/**
	 * 生成签名
	 *
	 * @param array $data
	 * @return string
	 */
	public function makeSign(array $data){
		$signStr = Util::buildUrlQuery($data);

		$hashSign = hash_hmac("sha256", $signStr, $this->getAccessKeySecret(), true);
		$hashSign = base64_encode($hashSign);

		return $hashSign;
	}

	/**
	 * 检查签名是否正确
	 *
	 * @param array  $data
	 * @param string $verifySignature
	 * @return boolean
	 */
	public function checkSign($data = null, $verifySignature = null){
		if(empty($data)){
			$data =& $_POST;
		}

		if(empty($verifySignature)){
			$verifySignature = self::getVerifySignString();

			if(empty($verifySignature)) return false;
		}

		$generateSignature = $this->makeSign($data);
		return $generateSignature == $verifySignature;
	}

	/**
	 * 获取要验证的签名字符串
	 *
	 * @return bool|string
	 */
	public static function getVerifySignString(){
		$verifySignature = isset($_SERVER['HTTP_X_SERVERLESS_SPI_SIGN']) ? $_SERVER['HTTP_X_SERVERLESS_SPI_SIGN'] : '';
		if(empty($verifySignature)){
			return false;
		}
		return $verifySignature;
	}
}
