<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<657306123@qq.com>
 * @date: 2019/11/8 15:36
 */

namespace duoguan\aliyun\serverless\logger;

use Psr\Log\AbstractLogger;

class PrintLogger extends AbstractLogger{

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
		$time = date('Y-m-d H:i:s');
		$context = array_map(function($item){
			return is_scalar($item) ? $item : json_encode($item, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		}, $context);
		array_unshift($context, "[{$level}] {$time} {$message} \n\n");
		echo call_user_func_array('sprintf', $context);
	}
}
