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
	public function where($where){
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
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 */
	public function insert($data, $options = []){
		return $this->dbService->insertOne(
			$this->name,
			$data,
			$options
		);
	}

	/**
	 * 删除数据
	 *
	 * @param array $options
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 * @throws \duoguan\aliyun\serverless\core\DbException
	 */
	public function delete($options = []){
		$filter = isset($this->options['where']) ? $this->options['where'] : [];
		if(empty($filter)) throw new DbException("删除操作必须包含表达式！");

		return $this->dbService->deleteMany(
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
	 * @return array
	 * @throws \duoguan\aliyun\serverless\ServerlessException
	 * @throws \duoguan\aliyun\serverless\core\DbException
	 */
	public function update($data, $options = []){
		$filter = isset($this->options['where']) ? $this->options['where'] : [];
		if(empty($filter)) throw new DbException("更新操作必须包含表达式！");

		return $this->dbService->updateMany(
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
	public function find($options = []){
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
	public function findAll($options = []){
		$filter = isset($this->options['where']) ? $this->options['where'] : [];
		return $this->dbService->find(
			$this->name,
			$filter,
			$options
		);
	}

}
