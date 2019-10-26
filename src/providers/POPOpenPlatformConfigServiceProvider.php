<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<657306123@qq.com>
 * @date: 2019/10/26 15:26
 */

namespace duoguan\aliyun\serverless\providers;

use duoguan\aliyun\serverless\kernel\POPCloudFuncService;
use xin\container\Container;
use xin\container\ProviderInterface;

class POPOpenPlatformConfigServiceProvider implements ProviderInterface{

	/**
	 * 注册服务
	 *
	 * @param \xin\container\Container $container
	 */
	public function register(Container $container){
		$container->singleton('func', function() use ($container){
			return new POPOpenPlatformConfigService($container);
		});
	}
}
