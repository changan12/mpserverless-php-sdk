<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<657306123@qq.com>
 * @date: 2019/10/24 14:18
 */

namespace duoguan\aliyun\serverless\core;

use duoguan\aliyun\serverless\kernel\DbService;

class DbCollection{

	/**
	 * @var DbService
	 */
	private $dbService = null;

	/**
	 * @var array
	 */
	protected $options = [];

	/**
	 * @var string
	 */
	private $name;

	/**
	 * DbCollection constructor.
	 *
	 * @param DbService $dbService
	 * @param string    $name
	 */
	public function __construct(DbService $dbService, $name){
		$this->dbService = $dbService;
		$this->name = $name;
	}

	/**
	 * 筛选条件
	 *
	 * @param array $where
	 * @return $this
	 */
	public function where(array $where){
		$this->options['where'] = $where;
		return $this;
	}

	/**
	 * 清除配置
	 *
	 * @return $this
	 */
	public function removeOptions(){
		$this->options = [];
		return $this;
	}

	/**
	 * 新增数据
	 *
	 * @param array $data
	 * @param array $options
	 * @return string
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function insert(array $data, array $options = []){
		return $this->dbService->insertOne(
			$this->name,
			$data,
			$options
		);
	}

	/**
	 * 新增多条数据
	 *
	 * @param array $data
	 * @param array $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function insertMany(array $data = [], array $options = []){
		return $this->dbService->insertMany(
			$this->name,
			$data,
			$options
		);
	}

	/**
	 * 删除数据
	 *
	 * @param array $options
	 * @param bool  $force 是否强制删除
	 * @return int
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 * @throws \duoguan\aliyun\serverless\core\DbException
	 */
	public function delete(array $options = [], $force = false){
		$filter = isset($this->options['where']) ? $this->options['where'] : [];
		if(!$force && empty($filter)){
			throw new DbException("删除操作必须包含表达式！");
		}

		return $this->dbService->deleteMany(
			$this->name,
			$filter,
			$options
		);
	}

	/**
	 * 删除单条数据
	 *
	 * @param array $options
	 * @param bool  $force 是否强制删除
	 * @return int
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 * @throws \duoguan\aliyun\serverless\core\DbException
	 */
	public function deleteOne(array $options = [], $force = false){
		$filter = isset($this->options['where']) ? $this->options['where'] : [];
		if(!$force && empty($filter)){
			throw new DbException("删除操作必须包含表达式！");
		}

		return $this->dbService->deleteOne(
			$this->name,
			$filter,
			$options
		);
	}

	/**
	 * 查找一条数据后删除
	 *
	 * @param array $options
	 * @param bool  $force 是否强制执行
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 * @throws \duoguan\aliyun\serverless\core\DbException
	 */
	public function findOneAndDelete(array $options = [], $force = false){
		$filter = isset($this->options['where']) ? $this->options['where'] : [];
		if(!$force && empty($filter)){
			throw new DbException("必须包含表达式！");
		}

		return $this->dbService->findOneAndDelete(
			$this->name,
			$filter,
			$options
		);
	}

	/**
	 * 更新数据
	 *
	 * @param array $data
	 * @param array $options
	 * @param bool  $force 是否强制执行
	 * @return int
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 * @throws \duoguan\aliyun\serverless\core\DbException
	 */
	public function update(array $data, array $options = [], $force = false){
		$filter = isset($this->options['where']) ? $this->options['where'] : [];
		if(!$force && empty($filter)){
			throw new DbException("更新操作必须包含表达式！");
		}

		return $this->dbService->updateMany(
			$this->name,
			$filter,
			$data,
			$options
		);
	}

	/**
	 * 更新一条数据
	 *
	 * @param array $data
	 * @param array $options
	 * @param bool  $force 是否强制执行
	 * @return int
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 * @throws \duoguan\aliyun\serverless\core\DbException
	 */
	public function updateOne(array $data, array $options = [], $force = false){
		$filter = isset($this->options['where']) ? $this->options['where'] : [];
		if(!$force && empty($filter)){
			throw new DbException("更新操作必须包含表达式！");
		}

		return $this->dbService->updateOne(
			$this->name,
			$filter,
			$data,
			$options
		);
	}

	/**
	 * 查找一条数据后更新
	 *
	 * @param array $data
	 * @param array $options
	 * @param bool  $force 是否强制执行
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 * @throws \duoguan\aliyun\serverless\core\DbException
	 */
	public function findOneAndUpdate(array $data = [], array $options = [], $force = false){
		$filter = isset($this->options['where']) ? $this->options['where'] : [];
		if(!$force && empty($filter)){
			throw new DbException("必须包含表达式！");
		}

		return $this->dbService->findOneAndUpdate(
			$this->name,
			$filter,
			$data,
			$options
		);
	}

	/**
	 * 查找单个数据
	 *
	 * @param array $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function find(array $options = []){
		$filter = isset($this->options['where']) ? $this->options['where'] : [];
		return $this->dbService->findOne(
			$this->name,
			$filter,
			$options
		);
	}

	/**
	 * 查找多个数据
	 *
	 * @param array $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function findAll(array $options = []){
		$filter = isset($this->options['where']) ? $this->options['where'] : [];
		return $this->dbService->find(
			$this->name,
			$filter,
			$options
		);
	}

	/**
	 * 查找一条数据后替换
	 *
	 * @param array $replacement
	 * @param array $options
	 * @param bool  $force 是否强制执行
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 * @throws \duoguan\aliyun\serverless\core\DbException
	 */
	public function findOneAndReplace(array $replacement = [], array $options = [], $force = false){
		$filter = isset($this->options['where']) ? $this->options['where'] : [];
		if(!$force && empty($filter)){
			throw new DbException("必须包含表达式！");
		}

		return $this->dbService->findOneAndReplace(
			$this->name,
			$filter,
			$replacement,
			$options
		);
	}

	/**
	 * 查询集合里面的数据并返回总数量
	 *
	 * @param array $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function findAndTotalRows(array $options = []){
		$filter = isset($this->options['where']) ? $this->options['where'] : [];
		return $this->dbService->findAndTotalRows(
			$this->name,
			$filter,
			$options
		);
	}

	/**
	 * 聚合查询
	 *
	 * @param array $pipeline
	 * @param array $options
	 * @return mixed
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function aggregate(array $pipeline = [], array $options = []){
		return $this->dbService->aggregate(
			$this->name,
			$pipeline,
			$options
		);
	}

	/**
	 * 统计数量
	 *
	 * @param array  $options
	 * @return int
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function count(array $options = []){
		$filter = isset($this->options['where']) ? $this->options['where'] : [];
		return $this->dbService->count(
			$this->name,
			$filter,
			$options
		);
	}

	/**
	 * 返回唯一不同的值
	 *
	 * @param string $key
	 * @param array  $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function distinct($key, array $options = []){
		$filter = isset($this->options['where']) ? $this->options['where'] : [];
		return $this->dbService->distinct(
			$this->name,
			$key,
			$filter,
			$options
		);
	}
}
