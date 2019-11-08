<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<657306123@qq.com>
 * @date: 2019/11/8 15:52
 */

namespace duoguan\aliyun\serverless\logger;

use Psr\Log\AbstractLogger;

class EmptyLogger extends AbstractLogger{

	/**
	 * Logs with an arbitrary level.
	 *
	 * @param mixed  $level
	 * @param string $message
	 * @param array  $context
	 * @return void
	 * @throws \Psr\Log\InvalidArgumentException
	 */
	public function log($level, $message, array $context = []){
		// 啥事也不干~
	}
}
