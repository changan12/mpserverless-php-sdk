<?php
/**
 * Created by PhpStorm.
 * User: 1458790210@qq.com
 * Date: 2019/10/15
 * Time: 14:46
 */

namespace duoguan\aliyun\serverless\kernel;

/**
 * Class CloudCallService
 *
 * @package duoguan\aliyun\serverless\kernel
 */
class CloudCallService{

	/**
	 * 服务名称
	 */
	const SERVICE_NAME = "serverless.function.isv.runtime.invoke";

	/**
	 * @var \duoguan\aliyun\serverless\Serverless
	 */
	protected $serverless;

	/**
	 * CloudCallService constructor.
	 *
	 * @param $serverless
	 */
	public function __construct($serverless){
		$this->serverless = $serverless;
	}

	/**
	 * @param $params
	 * @return string
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	private function request($params){
		return $this->serverless->request([
			'method' => self::SERVICE_NAME,
			'params' => json_encode($params),
		]);
	}

	/**
	 * 调用云函数
	 *
	 * @param string $functionTarget
	 * @param array  $functionArgs
	 * @return string
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function invoke($functionTarget, $functionArgs){
		return $this->request([
			'functionTarget' => $functionTarget,
			'functionArgs'   => empty($functionArgs) ? new \stdClass() : $functionArgs,
		]);
	}

}
