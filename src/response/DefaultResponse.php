<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<657306123@qq.com>
 * @date: 2019/11/13 11:38
 */

namespace duoguan\aliyun\serverless\response;

use Psr\Http\Message\ResponseInterface as HttpResponseInterface;
use Traversable;

class DefaultResponse implements ResponseInterface{

	/**
	 * @var HttpResponseInterface
	 */
	protected $response = null;

	/**
	 * @var mixed
	 */
	protected $data = null;

	/**
	 * @var string
	 */
	protected $spaceId;

	/**
	 * Response constructor.
	 *
	 * @param                                     $spaceId
	 * @param \Psr\Http\Message\ResponseInterface $response
	 */
	public function __construct($spaceId, HttpResponseInterface $response){
		$this->spaceId = $spaceId;
		$this->response = $response;
		$this->data = $this->getRawData();
	}

	/**
	 * Whether a offset exists
	 *
	 * @link https://php.net/manual/en/arrayaccess.offsetexists.php
	 * @param mixed $offset <p>
	 * An offset to check for.
	 * </p>
	 * @return bool true on success or false on failure.
	 * </p>
	 * <p>
	 * The return value will be casted to boolean if non-boolean was returned.
	 * @since 5.0.0
	 */
	public function offsetExists($offset){
		return isset($this->data[$offset]);
	}

	/**
	 * Offset to retrieve
	 *
	 * @link https://php.net/manual/en/arrayaccess.offsetget.php
	 * @param mixed $offset <p>
	 * The offset to retrieve.
	 * </p>
	 * @return mixed Can return all value types.
	 * @since 5.0.0
	 */
	public function offsetGet($offset){
		return $this->data[$offset];
	}

	/**
	 * Offset to set
	 *
	 * @link https://php.net/manual/en/arrayaccess.offsetset.php
	 * @param mixed $offset <p>
	 * The offset to assign the value to.
	 * </p>
	 * @param mixed $value <p>
	 * The value to set.
	 * </p>
	 * @return void
	 * @since 5.0.0
	 */
	public function offsetSet($offset, $value){
		$this->data[$offset] = $value;
	}

	/**
	 * Offset to unset
	 *
	 * @link https://php.net/manual/en/arrayaccess.offsetunset.php
	 * @param mixed $offset <p>
	 * The offset to unset.
	 * </p>
	 * @return void
	 * @since 5.0.0
	 */
	public function offsetUnset($offset){
		unset($this->data[$offset]);
	}

	/**
	 * get request id
	 *
	 * @return string
	 */
	public function getRequestId(){
		return $this->response->getHeaderLine('request-id');
	}

	/**
	 * get space id
	 *
	 * @return string
	 */
	public function getSpaceId(){
		return $this->spaceId;
	}

	/**
	 * 重新装载数据源
	 *
	 * @param array $data
	 * @return \duoguan\aliyun\serverless\response\DefaultResponse
	 */
	public function withDataSource($data){
		$self = clone $this;
		$self->data = $data;

		return $self;
	}

	/**
	 * 获取原始数据
	 *
	 * @return array
	 */
	public function getRawData(){
		$result = $this->response->getBody()->getContents();
		$result = json_decode($result, true);
		return $result;
	}

	/**
	 * 返回设置的数据源
	 *
	 * @return mixed
	 */
	public function value(){
		return $this->data;
	}

	/**
	 *变量是否为标量类型
	 *
	 * @return boolean
	 */
	public function isScalar(){
		return is_scalar($this->data);
	}

	/**
	 * @inheritDoc
	 */
	public function isNullData(){
		return is_null($this->data);
	}

	/**
	 * 转换成字符串
	 *
	 * @return string
	 */
	public function __toString(){
		return (string)$this->data;
	}

	/**
	 * Specify data which should be serialized to JSON
	 *
	 * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	public function jsonSerialize(){
		return $this->data;
	}

	/**
	 * Retrieve an external iterator
	 *
	 * @link https://php.net/manual/en/iteratoraggregate.getiterator.php
	 * @return Traversable An instance of an object implementing <b>Iterator</b> or
	 * <b>Traversable</b>
	 * @since 5.0.0
	 */
	public function getIterator(){
		return new \ArrayIterator($this->data);
	}

	/**
	 * Count elements of an object
	 *
	 * @link https://php.net/manual/en/countable.count.php
	 * @return int The custom count as an integer.
	 * </p>
	 * <p>
	 * The return value is cast to an integer.
	 * @since 5.1.0
	 */
	public function count(){
		return count($this->data);
	}

}
