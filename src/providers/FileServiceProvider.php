<?php
/**
 * Created by PhpStorm.
 * User: 1458790210@qq.com
 * Date: 2019/10/15
 * Time: 14:54
 */
namespace xin\serverless\providers;

use xin\container\Container;
use xin\container\ProviderInterface;
use xin\serverless\kernel\FileService;

class FileServiceProvider implements ProviderInterface
{

    /**
     * 注册服务
     *
     * @param \xin\container\Container $container
     */
    public function register(Container $container)
    {
        $container->singleton('file', function () use ($container) {
            return new FileService($container);
        });
    }
}