<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<liuxingwu@duoguan.com>
 * @date: 2019/10/14 18:56
 */

namespace xin\serverless\kernel;

class DbService{

	/**
	 * @var \xin\serverless\Serverless
	 */
	protected $serverless;

	/**
	 * DbService constructor.
	 *
	 * @param $serverless
	 */
	public function __construct($serverless){ $this->serverless = $serverless; }

	public function insert($collection, $options = []){
		// todo
	}

	public function delete($collection, $query = null, $options = []){
		// todo
	}

	public function update($collection, $query = null, $options = []){
		// todo
	}

	public function select($collection, $query = null, $options = []){
		// todo
	}

	public function find($collection, $query, $options = []){
		// todo
		return $this->serverless->request([
			'method' => 'serverless.db.isv.execute',
			'params' => json_encode([
				'command'    => 'findOne',
				'collection' => $collection,
				'query'      => $query,
				'options'    => $options,
			]),
		]);
	}

}
