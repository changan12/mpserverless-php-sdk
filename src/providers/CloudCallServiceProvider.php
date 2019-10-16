<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<liuxingwu@duoguan.com>
 * @date: 2019/10/14 18:53
 */

namespace duoguan\aliyun\serverless\providers;

use duoguan\aliyun\serverless\kernel\CloudCallService;
use xin\container\Container;
use xin\container\ProviderInterface;

class CloudCallServiceProvider implements ProviderInterface{

	/**
	 * 注册服务
	 *
	 * @param \xin\container\Container $container
	 */
	public function register(Container $container){
		$container->singleton('cloud', function() use ($container){
			return new CloudCallService($container);
		});
	}
}
