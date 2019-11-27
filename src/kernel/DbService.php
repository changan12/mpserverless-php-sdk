<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<liuxingwu@duoguan.com>
 * @date: 2019/10/14 18:56
 */

namespace duoguan\aliyun\serverless\kernel;

use duoguan\aliyun\serverless\core\DbCollection;

/**
 * Class DbService
 *
 * @package duoguan\aliyun\serverless\kernel
 */
class DbService extends BaseService{

	/**
	 * 服务名称
	 */
	const SERVICE_NAME = "serverless.db.isv.execute";

	/**
	 * 插入一条
	 *
	 * @param string $collection
	 * @param array  $doc
	 * @param array  $options
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function insertOne($collection, array $doc = [], array $options = []){
		$result = $this->request(self::SERVICE_NAME, [
			'command'    => 'insertOne',
			'collection' => $collection,
			'doc'        => empty($doc) ? new \stdClass() : $doc,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
		return $result->withDataSource($result['result']['insertedId']);
	}

	/**
	 * 插入多条
	 *
	 * @param string $collection
	 * @param array  $docs
	 * @param array  $options
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface insert id list
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function insertMany($collection, array $docs = [], array $options = []){
		$result = $this->request(self::SERVICE_NAME, [
			'command'    => 'insertMany',
			'collection' => $collection,
			'docs'       => empty($docs) ? new \stdClass() : $docs,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
		return $result->withDataSource($result['result']);
	}

	/**
	 * 删除一条
	 *
	 * @param string $collection
	 * @param array  $filter
	 * @param array  $options
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function deleteOne($collection, array $filter = [], array $options = []){
		$result = $this->request(self::SERVICE_NAME, [
			'command'    => 'deleteOne',
			'collection' => $collection,
			'filter'     => empty($filter) ? new \stdClass() : $filter,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
		return $result->withDataSource($result['affectedDocs']);
	}

	/**
	 * 删除多条
	 *
	 * @param string $collection
	 * @param array  $filter
	 * @param array  $options
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function deleteMany($collection, array $filter = [], array $options = []){
		$this->applyPageOptions($options);
		$result = $this->request(self::SERVICE_NAME, [
			'command'    => 'deleteMany',
			'collection' => $collection,
			'filter'     => empty($filter) ? new \stdClass() : $filter,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
		return $result->withDataSource($result['affectedDocs']);
	}

	/**
	 * 查找一条数据后删除
	 *
	 * @param string $collection
	 * @param array  $filter
	 * @param array  $options
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function findOneAndDelete($collection, array $filter = [], array $options = []){
		$result = $this->request(self::SERVICE_NAME, [
			'command'    => 'findOneAndDelete',
			'collection' => $collection,
			'filter'     => empty($filter) ? new \stdClass() : $filter,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
		return $result->withDataSource($result['result']['value']);
	}

	/**
	 * 更新一条数据
	 *
	 * @param string $collection
	 * @param array  $filter
	 * @param array  $update
	 * @param array  $options
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function updateOne($collection, array $filter = [], array $update = [], array $options = []){
		$result = $this->request(self::SERVICE_NAME, [
			'command'    => 'updateOne',
			'collection' => $collection,
			'update'     => empty($update) ? new \stdClass() : $update,
			'filter'     => empty($filter) ? new \stdClass() : $filter,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
		return $result->withDataSource($result['affectedDocs']);
	}

	/**
	 * 更新多条数据
	 *
	 * @param string $collection
	 * @param array  $filter
	 * @param array  $update
	 * @param array  $options
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function updateMany($collection, array $filter = [], array $update = [], array $options = []){
		$this->applyPageOptions($options);
		$result = $this->request(self::SERVICE_NAME, [
			'command'    => 'updateMany',
			'collection' => $collection,
			'update'     => empty($update) ? new \stdClass() : $update,
			'filter'     => empty($filter) ? new \stdClass() : $filter,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
		return $result->withDataSource($result['affectedDocs']);
	}

	/**
	 * 查找一条数据后更新
	 *
	 * @param string $collection
	 * @param array  $filter
	 * @param array  $update
	 * @param array  $options
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function findOneAndUpdate($collection, array $filter = [], array $update = [], array $options = []){
		$result = $this->request(self::SERVICE_NAME, [
			'command'    => 'findOneAndUpdate',
			'collection' => $collection,
			'update'     => empty($update) ? new \stdClass() : $update,
			'filter'     => empty($filter) ? new \stdClass() : $filter,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
		return $result->withDataSource($result['result']['value']);
	}

	/**
	 * 替换一条
	 *
	 * @param string $collection
	 * @param array  $filter
	 * @param array  $doc
	 * @param array  $options
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function replaceOne($collection, array $filter = [], array $doc = [], array $options = []){
		$result = $this->request(self::SERVICE_NAME, [
			'command'    => 'replaceOne',
			'collection' => $collection,
			'filter'     => empty($filter) ? new \stdClass() : $filter,
			'doc'        => empty($doc) ? new \stdClass() : $doc,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
		return $result->withDataSource($result['affectedDocs']);
	}

	/**
	 * 查找一条数据后替换
	 *
	 * @param string $collection
	 * @param array  $filter
	 * @param array  $replacement
	 * @param array  $options
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function findOneAndReplace($collection, array $filter = [], array $replacement = [], array $options = []){
		$result = $this->request(self::SERVICE_NAME, [
			'command'     => 'findOneAndReplace',
			'collection'  => $collection,
			'filter'      => empty($filter) ? new \stdClass() : $filter,
			'replacement' => empty($replacement) ? new \stdClass() : $replacement,
			'options'     => empty($options) ? new \stdClass() : $options,
		]);
		return $result->withDataSource($result['result']['value']);
	}

	/**
	 * 查询一条
	 *
	 * @param string $collection
	 * @param array  $query
	 * @param array  $options
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function findOne($collection, array $query = [], array $options = []){
		$result = $this->request(self::SERVICE_NAME, [
			'command'    => 'findOne',
			'collection' => $collection,
			'query'      => empty($query) ? new \stdClass() : $query,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
		return $result->withDataSource($result['result']);
	}

	/**
	 * 查询所有
	 *
	 * @param string $collection
	 * @param array  $query
	 * @param array  $options
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function find($collection, array $query = [], array $options = []){
		$this->applyPageOptions($options);
		$result = $this->request(self::SERVICE_NAME, [
			'command'    => 'find',
			'collection' => $collection,
			'query'      => empty($query) ? new \stdClass() : $query,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
		return $result->withDataSource($result['result']);
	}

	/**
	 * 查询集合里面的数据并返回总数量
	 *
	 * @param string $collection
	 * @param array  $query
	 * @param array  $options
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function findAndTotalRows($collection, array $query = [], array $options = []){
		$data = $this->find($collection, $query, $options);
		$totalRows = $this->count($collection, $query);

		$result = $data->withDataSource([
			'data'      => $data->value(),
			'totalRows' => $totalRows->value(),
		]);

		if(isset($options['paginate']) && is_callable($options['paginate'])){
			return call_user_func($options['paginate'], $result, $options);
		}

		return $result;
	}

	/**
	 * 聚合查询
	 *
	 * @param string $collection
	 * @param array  $pipeline
	 * @param array  $options
	 * @return mixed
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function aggregate($collection, array $pipeline = [], array $options = []){
		$result = $this->request(self::SERVICE_NAME, [
			'command'    => 'aggregate',
			'collection' => $collection,
			'pipeline'   => empty($pipeline) ? new \stdClass() : $pipeline,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
		return $result->withDataSource($result['result']);
	}

	/**
	 * 统计数量
	 *
	 * @param string $collection
	 * @param array  $query
	 * @param array  $options
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function count($collection, array $query = [], array $options = []){
		$result = $this->request(self::SERVICE_NAME, [
			'command'    => 'count',
			'collection' => $collection,
			'query'      => empty($query) ? new \stdClass() : $query,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
		return $result->withDataSource($result['result']);
	}

	/**
	 * 返回唯一不同的值
	 *
	 * @param string $collection
	 * @param string $key
	 * @param array  $query
	 * @param array  $options
	 * @return \duoguan\aliyun\serverless\response\ResponseInterface
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function distinct($collection, $key, array $query = [], array $options = []){
		$result = $this->request(self::SERVICE_NAME, [
			'command'    => 'distinct',
			'collection' => $collection,
			'key'        => $key,
			'query'      => empty($query) ? new \stdClass() : $query,
			'options'    => empty($options) ? new \stdClass() : $options,
		]);
		return $result->withDataSource($result['result']);
	}

	/**
	 * 支持 page 自动转换skip属性
	 *
	 * @param array $options
	 */
	private function applyPageOptions(array &$options){
		if(isset($options['page'])){
			$page = intval($options['page']);
			$page = $page < 1 ? 1 : $page;

			$options['limit'] = isset($options['limit']) ? $options['limit'] : 20;
			$options['skip'] = ($page - 1) * $options['limit'];
		}
	}

	/**
	 * 获取集合实例
	 *
	 * @param string $name
	 * @return \duoguan\aliyun\serverless\core\DbCollection
	 */
	public function collection($name){
		return new DbCollection($this, $name);
	}
}
