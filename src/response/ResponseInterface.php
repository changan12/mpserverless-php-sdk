<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<657306123@qq.com>
 * @date: 2019/11/13 11:44
 */

namespace duoguan\aliyun\serverless\response;

interface ResponseInterface extends \ArrayAccess, \Countable, \IteratorAggregate, \JsonSerializable{

	/**
	 * get request id
	 *
	 * @return string
	 */
	public function getRequestId();

	/**
	 * get space id
	 *
	 * @return string
	 */
	public function getSpaceId();

	/**
	 * 获取原始数据
	 *
	 * @return array
	 */
	public function getRawData();

	/**
	 * 重新装载数据源
	 *
	 * @param array $data
	 * @return ResponseInterface
	 */
	public function withDataSource($data);

	/**
	 * 返回设置的数据源
	 *
	 * @return mixed
	 */
	public function value();

	/**
	 *变量是否为标量类型
	 *
	 * @return boolean
	 */
	public function isScalar();
}
