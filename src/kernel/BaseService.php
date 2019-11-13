<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<657306123@qq.com>
 * @date: 2019/10/26 15:10
 */

namespace duoguan\aliyun\serverless\kernel;

/**
 * Class BaseService
 *
 * @package duoguan\aliyun\serverless\kernel
 */
abstract class BaseService{

	/**
	 * @var \duoguan\aliyun\serverless\Serverless
	 */
	protected $serverless;

	/**
	 * BaseService constructor.
	 *
	 * @param $serverless
	 */
	public function __construct($serverless){
		$this->serverless = $serverless;
	}

	/**
	 * 请求数据
	 *
	 * @param string $service
	 * @param array  $params
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	protected function request($service, $params){
		return $this->serverless->request([
			'method' => $service,
			'params' => json_encode($params),
		]);
	}
}
