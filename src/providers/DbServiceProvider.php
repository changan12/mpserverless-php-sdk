<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<liuxingwu@duoguan.com>
 * @date: 2019/10/14 18:48
 */

namespace duoguan\aliyun\serverless\providers;

use duoguan\aliyun\serverless\kernel\DbService;
use xin\container\Container;
use xin\container\ProviderInterface;

class DbServiceProvider implements ProviderInterface{

	/**
	 * 注册服务
	 *
	 * @param \xin\container\Container $container
	 */
	public function register(Container $container){
		$container->singleton('db', function() use ($container){
			return new DbService($container);
		});
	}
}
