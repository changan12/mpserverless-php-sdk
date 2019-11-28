<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<liuxingwu@duoguan.com>
 * @date: 2019/10/15 11:03
 */
namespace duoguan\aliyun\serverless;

class ServerlessException extends \Exception{

	/**
	 * @var string
	 */
	private $requestId;

	/**
	 * Construct the exception. Note: The message is NOT binary safe.
	 *
	 * @link https://php.net/manual/en/exception.construct.php
	 * @param string     $message [optional] The Exception message to throw.
	 * @param int        $code [optional] The Exception code.
	 * @param string     $requestId
	 * @param \Throwable $previous [optional] The previous throwable used for the exception chaining.
	 * @since 5.1.0
	 */
	public function __construct($message = "", $code = 0, \Throwable $previous = null){
		parent::__construct($message, $code, $previous);
	}

	/**
	 * @param string $requestId
	 */
	public function setRequestId($requestId){
		$this->requestId = $requestId;
	}

	/**
	 * @return string
	 */
	public function getRequestId(){
		return $this->requestId;
	}

}
