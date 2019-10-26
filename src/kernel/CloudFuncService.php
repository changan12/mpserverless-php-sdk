<?php
/**
 * Created by PhpStorm.
 * User: 1458790210@qq.com
 * Date: 2019/10/15
 * Time: 14:46
 */

namespace duoguan\aliyun\serverless\kernel;

/**
 * Class CloudFuncService
 *
 * @package duoguan\aliyun\serverless\kernel
 */
class CloudFuncService extends BaseService{

	/**
	 * 服务名称
	 */
	const SERVICE_NAME = "serverless.function.isv.runtime.invoke";

	/**
	 * 调用云函数
	 *
	 * @param string $functionTarget
	 * @param array  $functionArgs
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function invoke($functionTarget, $functionArgs){
		return $this->request(self::SERVICE_NAME, [
			'functionTarget' => $functionTarget,
			'functionArgs'   => empty($functionArgs) ? new \stdClass() : $functionArgs,
		]);
	}

}
