<?php
/**
 * Created by PhpStorm.
 * User: 1458790210@qq.com
 * Date: 2019/10/15
 * Time: 14:55
 */

namespace xin\serverless\kernel;

class FileService
{

    /**
     * @var \xin\serverless\Serverless
     */
    protected $serverless;

    /**
     * FileService constructor.
     *
     * @param $serverless
     */
    public function __construct($serverless)
    {
        $this->serverless = $serverless;
    }

    public function fileDelete($id)
    {
        return $this->serverless->request([
            'method' => 'serverless.file.resource.isv.delete',
            'params' => json_encode([
                'id' => $id,
            ]),
        ]);
    }

    public function fileReport($id, $contentType)
    {
        return $this->serverless->request([
            'method' => 'serverless.file.resource.isv.report',
            'params' => json_encode([
                'id' => $id,
                'contentType' => $contentType,
            ]),
        ]);
    }

    public function fileGenerateProximalSign($env, $filename, $size, $targetPath)
    {
        return $this->serverless->request([
            'method' => 'serverless.file.resource.isv.generateProximalSign',
            'params' => json_encode([
                'env' => $env,
                'filename' => $filename,
                'size' => $size,
                'targetPath' => $targetPath,
            ]),
        ]);
    }

}