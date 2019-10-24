<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<657306123@qq.com>
 * @date: 2019/10/21 11:45
 */
namespace duoguan\aliyun\serverless;

use GuzzleHttp\Client;
use xin\container\ProviderContainer;

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
		$clientConfig = isset($config['client']) ? $config['client'] : [];
		$this->httpClient = new Client(array_merge([
			'base_uri' => self::GATEWAY_URL,
			'timeout'  => 2.0,
		], $clientConfig));

		$this->config = $config;

		$this->registerProviders();
	}
}
