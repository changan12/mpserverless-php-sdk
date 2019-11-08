<?php
/**
 * Created by PhpStorm.
 * User: 1458790210@qq.com
 * Date: 2019/10/15
 * Time: 14:55
 */

namespace duoguan\aliyun\serverless\kernel;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Stream;
use Psr\Http\Message\RequestInterface;

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
	 * @return array
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
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function fileReport($id, $contentType = null){
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
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function fileGenerateProximalSign($env, $filename, $size = 0, $targetPath = null){
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

	/**
	 * 上传文件
	 *
	 * @param string $env
	 * @param string $filename
	 * @return array|null
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function putFile($env, $filename){
		// 获取预上传地址
		$result = $this->fileGenerateProximalSign($env, $filename);
		if(!$result || !$result['success']){
			return null;
		}

		// 上传文件
		$uploadInfo = $result['data'];
		try{
			$this->upload($uploadInfo, $filename, fopen($filename, 'r'));
		}catch(RequestException $e){
			$this->recordRequestException($e);

			if($this->serverless->isFailException()){
				throw $e;
			}else{
				return null;
			}
		}

		// 上报文件并入库
		$result = $this->fileReport($uploadInfo['id']);
		if(!$result || !$result['success']){
			return null;
		}

		return $this->buildSuccessResult($uploadInfo);
	}

	/**
	 * 上传文件
	 *
	 * @param string $env
	 * @param string $filename
	 * @param mixed  $data
	 * @return array|null
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function putData($env, $filename, $data){
		// 获取预上传地址
		$result = $this->fileGenerateProximalSign($env, $filename);
		if(!$result || !$result['success']){
			return null;
		}

		// 上传文件
		$uploadInfo = $result['data'];
		try{
			$this->upload($uploadInfo, $filename, $data);
		}catch(RequestException $e){
			$this->recordRequestException($e);

			if($this->serverless->isFailException()){
				throw $e;
			}else{
				return null;
			}
		}

		// 上报文件并入库
		$result = $this->fileReport($uploadInfo['id']);
		if(!$result || !$result['success']){
			return null;
		}

		return $this->buildSuccessResult($uploadInfo);
	}

	/**
	 * 记录异常记录
	 *
	 * @param \GuzzleHttp\Exception\RequestException $e
	 */
	private function recordRequestException(RequestException $e){
		$request = $e->getRequest();
		$request->getBody()->rewind();
		$response = $e->hasResponse() ? $e->getResponse() : null;
		$this->serverless->getLogger()->warning("bad request , request data : %s;response data : %s;", [
			$request->getBody()->getContents(),
			$response ? $response->getBody()->getContents() : "",
		]);
	}

	/**
	 * 编译上传后的结果
	 *
	 * @param array $uploadInfo
	 * @return array
	 */
	private function buildSuccessResult(array $uploadInfo){
		return [
			"id"   => $uploadInfo['id'],
			"path" => $uploadInfo['ossPath'],
			"host" => $uploadInfo['host'],
			"url"  => "http://".$uploadInfo['host']."/".$uploadInfo['ossPath'],
		];
	}

	/**
	 * 上传文件
	 *
	 * @param array  $uploadInfo
	 * @param string $filename
	 * @param mixed  $data
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	private function upload($uploadInfo, $filename, $data){
		$httpClient = new Client();
		$stack = HandlerStack::create();
		$stack->before('prepare_body', function(callable $handler){
			return function(RequestInterface $request, array $options) use ($handler){
				/** @var MultipartStream $aa */
				$contents = $request->getBody()->getContents();
				$contents = preg_replace("/Content-Length: \\d+\r\n?/is", "", $contents);

				$stream = fopen('php://temp', 'r+');
				fwrite($stream, $contents);
				fseek($stream, 0);
				$stream = new Stream($stream, $options);

				$request = $request->withBody($stream);
				return $handler($request, $options);
			};
		});

		$httpClient->request('POST', "https://".$uploadInfo['host'], [
			'handler'   => $stack,
			'headers'   => [
				"Cache-Control"                => "max-age=2592000",
				'X-OSS-server-side-encrpytion' => 'AES256',
			],
			'multipart' => [
				[
					'name'     => 'id',
					'contents' => $uploadInfo['id'],
				],
				[
					'name'     => 'key',
					'contents' => $uploadInfo['ossPath'],
				],
				[
					'name'     => 'host',
					'contents' => $uploadInfo['host'],
				],
				[
					'name'     => 'policy',
					'contents' => $uploadInfo['policy'],
				],
				[
					'name'     => 'Signature',
					'contents' => $uploadInfo['signature'],
				],
				[
					'name'     => 'OSSAccessKeyId',
					'contents' => $uploadInfo['accessKeyId'],
				],
				[
					'name'     => 'success_action_status',
					'contents' => '200',
				],
				[
					'name'     => 'file',
					'contents' => $data,
					'filename' => $filename,
					//					'headers'  => [
					//						'Content-Type' => 0,
					//					],
				],
			],
		]);
	}

}
