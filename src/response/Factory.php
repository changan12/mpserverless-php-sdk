<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<657306123@qq.com>
 * @date: 2019/11/13 11:48
 */

namespace duoguan\aliyun\serverless\response;

use Psr\Http\Message\ResponseInterface as HttpResponseInterface;

final class Factory{

	/**
	 * 制作一个ResponseInterface实现
	 *
	 * @param string                              $spaceId
	 * @param \Psr\Http\Message\ResponseInterface $response
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 */
	public static function make($spaceId, HttpResponseInterface $response){
		return new DefaultResponse($spaceId, $response);
	}
}
