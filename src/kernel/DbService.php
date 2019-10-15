<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<liuxingwu@duoguan.com>
 * @date: 2019/10/14 18:56
 */

namespace xin\serverless\kernel;

class DbService
{

    /**
     * @var \xin\serverless\Serverless
     */
    protected $serverless;

    /**
     * DbService constructor.
     *
     * @param $serverless
     */
    public function __construct($serverless)
    {
        $this->serverless = $serverless;
    }

    private function request($params)
    {
        return $this->serverless->request([
            'method' => 'serverless.db.isv.execute',
            'params' => json_encode($params),
        ]);
    }

    public function insertOne($collection, $doc, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'insertOne',
                'collection' => $collection,
                'doc' => empty($doc) ? new \stdClass() : $doc,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }

    public function insertMany($collection, $doc, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'insertMany',
                'collection' => $collection,
                'doc' => empty($doc) ? new \stdClass() : $doc,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }

    public function deleteOne($collection, $filter, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'deleteOne',
                'collection' => $collection,
                'filter' => empty($filter) ? new \stdClass() : $filter,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }

    public function deleteMany($collection, $filter, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'deleteMany',
                'collection' => $collection,
                'filter' => empty($filter) ? new \stdClass() : $filter,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }

    public function findOneAndDelete($collection, $filter, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'findOneAndDelete',
                'collection' => $collection,
                'filter' => empty($filter) ? new \stdClass() : $filter,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }

    public function findOneAndUpdate($collection, $filter, $update, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'findOneAndUpdate',
                'collection' => $collection,
                'update' => empty($update) ? new \stdClass() : $update,
                'filter' => empty($filter) ? new \stdClass() : $filter,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }

    public function updateOne($collection, $filter, $update, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'updateOne',
                'collection' => $collection,
                'update' => empty($update) ? new \stdClass() : $update,
                'filter' => empty($filter) ? new \stdClass() : $filter,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }

    public function updateMany($collection, $filter, $update, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'updateMany',
                'collection' => $collection,
                'update' => empty($update) ? new \stdClass() : $update,
                'filter' => empty($filter) ? new \stdClass() : $filter,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }

    public function findOneAndReplace($collection, $filter, $replacement, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'findOneAndReplace',
                'collection' => $collection,
                'filter' => empty($filter) ? new \stdClass() : $filter,
                'replacement' => empty($replacement) ? new \stdClass() : $replacement,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }

    public function replaceOne($collection, $filter, $doc, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'replaceOne',
                'collection' => $collection,
                'filter' => empty($filter) ? new \stdClass() : $filter,
                'doc' => empty($doc) ? new \stdClass() : $doc,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }


    public function select($collection, $doc, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'insertOne',
                'collection' => $collection,
                'doc' => empty($doc) ? new \stdClass() : $doc,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }

    public function findOne($collection, $query, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'findOne',
                'collection' => $collection,
                'query' => empty($query) ? new \stdClass() : $query,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }

    public function find($collection, $query, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'find',
                'collection' => $collection,
                'query' => empty($query) ? new \stdClass() : $query,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }

    public function aggregate($collection, $pipeline, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'aggregate',
                'collection' => $collection,
                'pipeline' => empty($pipeline) ? new \stdClass() : $pipeline,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }

    public function count($collection, $query, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'count',
                'collection' => $collection,
                'query' => empty($query) ? new \stdClass() : $query,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }

    public function distinct($collection, $query, $key, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'distinct',
                'collection' => $collection,
                'key' => empty($key) ? new \stdClass() : $key,
                'query' => empty($query) ? new \stdClass() : $query,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }

    /**
     * 创建索引
     * @param $collection
     * @param $field
     * @param array $options
     * @return string
     */
    public function createIndex($collection, $field, $options = [])
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'createIndex',
                'collection' => $collection,
                'field' => empty($field) ? new \stdClass() : $field,
                'options' => empty($options) ? new \stdClass() : $options,
            ]),
        ]);
    }

    /**
     * 查询索引
     * @param $collection
     * @return string
     */
    public function listIndex($collection)
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'listIndex',
                'collection' => $collection,
            ]),
        ]);
    }

    /**
     * 删除索引
     * @param $collection
     * @param $indexName
     * @return string
     */
    public function dropIndex($collection, $indexName)
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'dropIndex',
                'indexName' => empty($indexName) ? new \stdClass() : $indexName,
                'collection' => $collection,
            ]),
        ]);
    }

    /**
     * 创建集合
     * @param $collection
     * @param $name
     * @return string
     */
    public function createCollection($collection, $name)
    {
        return $this->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'createCollection',
                'name' => empty($name) ? new \stdClass() : $name,
                'collection' => $collection,
            ]),
        ]);
    }

    /**
     * 查询集合
     * @param $collection
     * @return string
     */
    public function findCollection($collection)
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'collections',
                'collection' => $collection,
            ]),
        ]);
    }

    /**
     * 删除集合
     * @param $collection
     * @return string
     */
    public function dropCollection($collection)
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'drop',
                'collection' => $collection,
            ]),
        ]);
    }

    /**
     * 重命名集合
     * @param $collection
     * @param $newName
     * @return string
     */
    public function renameCollection($collection, $newName)
    {
        return $this->request([
            'params' => json_encode([
                'command' => 'rename',
                'newName' => empty($newName) ? new \stdClass() : $newName,
                'collection' => $collection,
            ]),
        ]);
    }
}
