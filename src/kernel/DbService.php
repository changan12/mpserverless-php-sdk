<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<liuxingwu@duoguan.com>
 * @date: 2019/10/14 18:56
 */

namespace duoguan\aliyun\serverless\kernel;

/**
 * Class DbService
 *
 * @package duoguan\aliyun\serverless\kernel
 */
class DbService{

	/**
	 * 服务名称
	 */
	const SERVICE_NAME = "serverless.db.isv.execute";

	/**
	 * @var \duoguan\aliyun\serverless\Serverless
	 */
	protected $serverless;

	/**
	 * DbService constructor.
	 *
	 * @param $serverless
	 */
	public function __construct($serverless){
		$this->serverless = $serverless;
	}

	/**
	 * 执行数据库命令
	 *
	 * @param array $params
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	private function request($params){
		return $this->serverless->request([
			'method' => self::SERVICE_NAME,
			'params' => json_encode($params),
		]);
	}

	/**
	 * 插入一条
	 *
	 * @param string $collection
	 * @param array  $doc
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function insertOne($collection, $doc = [], $options = []){
		return $this->request([
			'command'    => 'insertOne',
			'collection' => $collection,
			'doc'        => empty($doc) ? new \stdClass() : $doc,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
	}

	/**
	 * 插入多条
	 *
	 * @param string $collection
	 * @param array  $docs
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function insertMany($collection, $docs = [], $options = []){
		return $this->request([
			'command'    => 'insertMany',
			'collection' => $collection,
			'docs'       => empty($docs) ? new \stdClass() : $docs,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
	}

	/**
	 * 删除一条
	 *
	 * @param string $collection
	 * @param array  $filter
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function deleteOne($collection, $filter = [], $options = []){
		return $this->request([
			'command'    => 'deleteOne',
			'collection' => $collection,
			'filter'     => empty($filter) ? new \stdClass() : $filter,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
	}

	/**
	 * 删除多条
	 *
	 * @param string $collection
	 * @param array  $filter
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function deleteMany($collection, $filter = [], $options = []){
		return $this->request([
			'command'    => 'deleteMany',
			'collection' => $collection,
			'filter'     => empty($filter) ? new \stdClass() : $filter,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
	}

	/**
	 * 查找一条数据后删除
	 *
	 * @param string $collection
	 * @param array  $filter
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function findOneAndDelete($collection, $filter = [], $options = []){
		return $this->request([
			'command'    => 'findOneAndDelete',
			'collection' => $collection,
			'filter'     => empty($filter) ? new \stdClass() : $filter,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
	}

	/**
	 * 查找一条数据后更新
	 *
	 * @param string $collection
	 * @param array  $filter
	 * @param array  $update
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function findOneAndUpdate($collection, $filter = [], $update = [], $options = []){
		return $this->request([
			'command'    => 'findOneAndUpdate',
			'collection' => $collection,
			'update'     => empty($update) ? new \stdClass() : $update,
			'filter'     => empty($filter) ? new \stdClass() : $filter,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
	}

	/**
	 * 更新一条数据
	 *
	 * @param string $collection
	 * @param array  $filter
	 * @param array  $update
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function updateOne($collection, $filter = [], $update = [], $options = []){
		return $this->request([
			'command'    => 'updateOne',
			'collection' => $collection,
			'update'     => empty($update) ? new \stdClass() : $update,
			'filter'     => empty($filter) ? new \stdClass() : $filter,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
	}

	/**
	 * 更新多条数据
	 *
	 * @param string $collection
	 * @param array  $filter
	 * @param array  $update
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function updateMany($collection, $filter = [], $update = [], $options = []){
		return $this->request([
			'command'    => 'updateMany',
			'collection' => $collection,
			'update'     => empty($update) ? new \stdClass() : $update,
			'filter'     => empty($filter) ? new \stdClass() : $filter,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
	}

	/**
	 * 查找一条数据后替换
	 *
	 * @param string $collection
	 * @param array  $filter
	 * @param array  $replacement
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function findOneAndReplace($collection, $filter = [], $replacement = [], $options = []){
		return $this->request([
			'command'     => 'findOneAndReplace',
			'collection'  => $collection,
			'filter'      => empty($filter) ? new \stdClass() : $filter,
			'replacement' => empty($replacement) ? new \stdClass() : $replacement,
			'options'     => empty($options) ? new \stdClass() : $options,
		]);
	}

	/**
	 * 替换一条
	 *
	 * @param string $collection
	 * @param array  $filter
	 * @param array  $doc
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function replaceOne($collection, $filter = [], $doc = [], $options = []){
		return $this->request([
			'command'    => 'replaceOne',
			'collection' => $collection,
			'filter'     => empty($filter) ? new \stdClass() : $filter,
			'doc'        => empty($doc) ? new \stdClass() : $doc,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
	}

	/**
	 * 查询一条
	 *
	 * @param string $collection
	 * @param array  $query
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function findOne($collection, $query = [], $options = []){
		return $this->request([
			'command'    => 'findOne',
			'collection' => $collection,
			'query'      => empty($query) ? new \stdClass() : $query,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
	}

	/**
	 * 查询所有
	 *
	 * @param string $collection
	 * @param array  $query
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function find($collection, $query = [], $options = []){
		return $this->request([
			'command'    => 'find',
			'collection' => $collection,
			'query'      => empty($query) ? new \stdClass() : $query,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
	}

	/**
	 * 聚合
	 *
	 * @param string $collection
	 * @param array  $pipeline
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function aggregate($collection, $pipeline = [], $options = []){
		return $this->request([
			'command'    => 'aggregate',
			'collection' => $collection,
			'pipeline'   => empty($pipeline) ? new \stdClass() : $pipeline,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
	}

	/**
	 * 统计数量
	 *
	 * @param string $collection
	 * @param array  $query
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function count($collection, $query = [], $options = []){
		return $this->request([
			'command'    => 'count',
			'collection' => $collection,
			'query'      => empty($query) ? new \stdClass() : $query,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
	}

	/**
	 * 返回唯一不同的值
	 *
	 * @param string $collection
	 * @param string $key
	 * @param array  $query
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function distinct($collection, $key, $query = [], $options = []){
		return $this->request([
			'command'    => 'distinct',
			'collection' => $collection,
			'key'        => $key,
			'query'      => empty($query) ? new \stdClass() : $query,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
	}

	/**
	 * 创建索引
	 *
	 * @param string $collection
	 * @param string $field
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function createIndex($collection, $field, $options = []){
		return $this->request([
			'command'    => 'createIndex',
			'collection' => $collection,
			'field'      => empty($field) ? new \stdClass() : $field,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
	}

	/**
	 * 查询索引
	 *
	 * @param string $collection
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function listIndexes($collection){
		return $this->request([
			'command'    => 'listIndexes',
			'collection' => $collection,
		]);
	}

	/**
	 * 删除索引
	 *
	 * @param string $collection
	 * @param string $indexName
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function dropIndex($collection, $indexName){
		return $this->request([
			'command'    => 'dropIndex',
			'indexName'  => empty($indexName) ? new \stdClass() : $indexName,
			'collection' => $collection,
		]);
	}

	/**
	 * 创建集合
	 *
	 * @param string $name
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function createCollection($name){
		return $this->request([
			'command' => 'createCollection',
			'name'    => $name,
		]);
	}

	/**
	 * 查询集合
	 *
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function findCollection(){
		return $this->request([
			'command' => 'collections',
		]);
	}

	/**
	 * 删除集合
	 *
	 * @param string $collection
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function dropCollection($collection){
		return $this->request([
			'command'    => 'drop',
			'collection' => $collection,
		]);
	}

	/**
	 * 重命名集合
	 *
	 * @param string $collection
	 * @param string $newName
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function renameCollection($collection, $newName){
		return $this->request([
			'command'    => 'rename',
			'newName'    => empty($newName) ? new \stdClass() : $newName,
			'collection' => $collection,
		]);
	}
}
