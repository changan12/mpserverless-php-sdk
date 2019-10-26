<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<liuxingwu@duoguan.com>
 * @date: 2019/10/14 18:42
 */

namespace duoguan\aliyun\serverless;

use duoguan\aliyun\serverless\providers\CloudFuncServiceProvider;
use duoguan\aliyun\serverless\providers\DbServiceProvider;
use duoguan\aliyun\serverless\providers\FileServiceProvider;
use GuzzleHttp\Client;
use xin\container\ProviderContainer;
use xin\helper\Str;
use xin\helper\Time;

/**
 * Class Serverless
 *
 * @property-read \duoguan\aliyun\serverless\kernel\DbService        db
 * @property-read \duoguan\aliyun\serverless\kernel\CloudFuncService func
 * @property-read \duoguan\aliyun\serverless\kernel\FileService      file
 * @package duoguan\aliyun\serverless
 */
class Serverless extends ProviderContainer{

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
			DbServiceProvider::class,
			CloudFuncServiceProvider::class,
			FileServiceProvider::class,
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

		$this->config = $config;

		$this->registerProviders();
	}

	/**
	 * 获取SpaceId
	 *
	 * @return mixed
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	protected function getSpaceId(){
		if(!isset($this->config['space_id']) || empty($this->config['space_id'])){
			throw new ServerlessException("space_id 没有配置.");
		}
		return $this->config['space_id'];
	}

	/**
	 * 获取privateKey
	 *
	 * @return mixed
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	protected function getPrivateKey(){
		if(!isset($this->config['private_key']) || empty($this->config['private_key'])){
			throw new ServerlessException("private_key 没有配置.");
		}
		return $this->config['private_key'];
	}

	/**
	 * 是否打印日志
	 *
	 * @return bool|mixed
	 */
	protected function isPrintLog(){
		return isset($this->config['is_print_log']) ? $this->config['is_print_log'] : false;
	}

	/**
	 * 打印日志
	 *
	 * @param string $content
	 */
	protected function log($content){
		if($this->isPrintLog()){
			if(!is_scalar($content)){
				$content = json_encode($content, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
			}
			echo "{$content}\n";
		}
	}

	/**
	 * 请求
	 *
	 * @param array $data
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function request(array $data){
		//		$data["spaceId"] = '655bc0ae-7dd0-4567-9083-4706bfea75e9'; // serverless spaceId
		$data['spaceId'] = $this->getSpaceId();
		$this->log("spaceId:{$data['spaceId']}");
		$data["timestamp"] = Time::getMillisecond(); // 毫秒级别时间戳

		$sign = self::makeSign($data, $this->getPrivateKey());
		$this->log("sign:{$sign}");
		if($this->isPrintLog()){
			$dataStr = http_build_query($data);
			$this->log("request body:{$dataStr}");
		}

		$options = [
			'headers'     => [
				'X-Serverless-Sign' => $sign,
			],
			'form_params' => $data,
		];
		$response = $this->httpClient->post('', $options);

		$result = $response->getBody()->getContents();
		$result = json_decode($result, true);

		return $result;
	}

	/**
	 * 制作签名
	 *
	 * @param array  $data
	 * @param string $privateKey
	 * @return string
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public static function makeSign($data, $privateKey){
		ksort($data);
		$dataStr = Str::buildUrlQuery($data, function($key, $val){
			return $key.'='.$val;
		});

		$pkId = openssl_get_privatekey($privateKey);
		if(!$pkId){
			throw new ServerlessException("不是一个正确的私钥！");
		}

		$verify = openssl_sign($dataStr, $signData, $pkId, OPENSSL_ALGO_MD5);
		if(!$verify){
			openssl_free_key($pkId);
			throw new ServerlessException("签名生成失败：".openssl_error_string());
		}

		openssl_free_key($pkId);

		return bin2hex($signData);
	}
}
