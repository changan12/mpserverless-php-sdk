<?php
/**
 * Created by PhpStorm.
 * User: 1458790210@qq.com
 * Date: 2019/10/15
 * Time: 14:55
 */

namespace duoguan\aliyun\serverless\kernel;

/**
 * Class FileService
 *
 * @package duoguan\aliyun\serverless\kernel
 */
class FileService{

	/**
	 * @var \duoguan\aliyun\serverless\Serverless
	 */
	protected $serverless;

	/**
	 * FileService constructor.
	 *
	 * @param $serverless
	 */
	public function __construct($serverless){
		$this->serverless = $serverless;
	}

	/**
	 * 删除文件
	 *
	 * @param string $id
	 * @return string
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function fileDelete($id){
		return $this->serverless->request([
			'method' => 'serverless.file.resource.isv.delete',
			'params' => json_encode([
				'id' => $id,
			]),
		]);
	}

	/**
	 * 上传⽂件数据⼊库
	 *
	 * @param string $id
	 * @param string $contentType
	 * @return string
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function fileReport($id, $contentType){
		return $this->serverless->request([
			'method' => 'serverless.file.resource.isv.report',
			'params' => json_encode([
				'id'          => $id,
				'contentType' => $contentType,
			]),
		]);
	}

	/**
	 * 获取⽂件近端上传的加签地址
	 *
	 * @param string $env
	 * @param string $filename
	 * @param int    $size
	 * @param string $targetPath
	 * @return string
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function fileGenerateProximalSign($env, $filename, $size, $targetPath){
		return $this->serverless->request([
			'method' => 'serverless.file.resource.isv.generateProximalSign',
			'params' => json_encode([
				'env'        => $env,
				'filename'   => $filename,
				'size'       => $size,
				'targetPath' => $targetPath,
			]),
		]);
	}

}
