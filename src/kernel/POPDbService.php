<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<657306123@qq.com>
 * @date: 2019/10/26 15:09
 */

namespace duoguan\aliyun\serverless\kernel;

class POPDbService extends POPBaseService{

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

}
