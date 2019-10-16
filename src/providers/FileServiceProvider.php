<?php
/**
 * Created by PhpStorm.
 * User: 1458790210@qq.com
 * Date: 2019/10/15
 * Time: 14:54
 */
namespace duoguan\aliyun\serverless\providers;

use duoguan\aliyun\serverless\kernel\FileService;
use xin\container\Container;
use xin\container\ProviderInterface;

class FileServiceProvider implements ProviderInterface{

	/**
	 * 注册服务
	 *
	 * @param \xin\container\Container $container
	 */
	public function register(Container $container){
		$container->singleton('file', function() use ($container){
			return new FileService($container);
		});
	}
}
