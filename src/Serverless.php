<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<liuxingwu@duoguan.com>
 * @date: 2019/10/14 18:42
 */

namespace duoguan\aliyun\serverless;

use duoguan\aliyun\serverless\logger\EmptyLogger;
use duoguan\aliyun\serverless\providers\CloudFuncServiceProvider;
use duoguan\aliyun\serverless\providers\DbServiceProvider;
use duoguan\aliyun\serverless\providers\FileServiceProvider;
use duoguan\aliyun\serverless\response\Factory as ResponseFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
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
class Serverless extends ProviderContainer implements LoggerAwareInterface{

	use LoggerAwareTrait;

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
			'timeout' => 5,
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
	 * 获取网关地址
	 *
	 * @return string
	 */
	public function getGatewayUrl(){
		return $this->isDebug() ? "https://api-pre.bspapp.com/server" : "https://api.bspapp.com/server";
	}

	/**
	 * 获取日志记录器
	 *
	 * @return LoggerInterface
	 */
	public function getLogger(){
		if(is_null($this->logger)){
			$this->logger = new EmptyLogger();
		}
		return $this->logger;
	}

	/**
	 * 是否是开发模式
	 *
	 * @return bool
	 */
	public function isDebug(){
		return isset($this->config['debug']) ? $this->config['debug'] : false;
	}

	/**
	 * 请求
	 *
	 * @param array $data
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function request(array $data){
		$data['spaceId'] = $this->getSpaceId();
		$data["timestamp"] = Time::getMillisecond(); // 毫秒级别时间戳

		$sign = self::makeSign($data, $this->getPrivateKey());
		$this->getLogger()->debug("make sign : %s", [$sign]);

		$dataStr = http_build_query($data);
		$this->getLogger()->debug("request data : %s", [$dataStr]);

		try{
			$options = [
				'headers'     => [
					'X-Serverless-Sign' => $sign,
				],
				'form_params' => $data,
			];

			$response = $this->httpClient->post($this->getGatewayUrl(), $options);

			$this->getLogger()->debug("response requestId : %s", [$response->getHeaderLine('request-id')]);
		}catch(RequestException $e){
			$response = $e->hasResponse() ? $e->getResponse() : null;
			if($response){
				$this->getLogger()->debug("response requestId : %s", [$response->getHeaderLine('request-id')]);
			}

			$this->getLogger()->warning("bad request , request data : %s;response data : %s;", [
				$e->getRequest(),
				$response ? $response->getBody()->getContents() : "",
			]);

			throw $e;
		}

		$result = ResponseFactory::make($this->getSpaceId(), $response);
		if(isset($result['success']) && !$result['success']){
			throw new ServerlessException($result['error']['message']."(".$result['error']['code'].")", 400040);
		}

		return $result->withDataSource($result['data']);
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
