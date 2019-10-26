<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<657306123@qq.com>
 * @date: 2019/10/26 15:17
 */

namespace duoguan\aliyun\serverless\kernel;

class POPBaseService{

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
}
