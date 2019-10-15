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
     * 执行数据库命令
     */
    const ISVEXECUTE = "serverless.db.isv.execute";

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

    public function insertOne($collection, $doc, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'insertOne',
                'collection' => $collection,
                'doc' => $doc,
                'options' => $options,
            ]),
        ]);
    }

    public function insertMany($collection, $doc, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'insertMany',
                'collection' => $collection,
                'doc' => $doc,
                'options' => $options,
            ]),
        ]);
    }

    public function deleteOne($collection, $filter, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'deleteOne',
                'collection' => $collection,
                'filter' => $filter,
                'options' => $options,
            ]),
        ]);
    }

    public function deleteMany($collection, $filter, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'deleteMany',
                'collection' => $collection,
                'filter' => $filter,
                'options' => $options,
            ]),
        ]);
    }

    public function findOneAndDelete($collection, $filter, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'findOneAndDelete',
                'collection' => $collection,
                'filter' => $filter,
                'options' => $options,
            ]),
        ]);
    }

    public function findOneAndUpdate($collection, $filter, $update, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'findOneAndUpdate',
                'collection' => $collection,
                'filter' => $filter,
                'update' => $update,
                'options' => $options,
            ]),
        ]);
    }

    public function updateOne($collection, $filter, $update, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'updateOne',
                'collection' => $collection,
                'filter' => $filter,
                'update' => $update,
                'options' => $options,
            ]),
        ]);
    }

    public function updateMany($collection, $filter, $update, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'updateMany',
                'collection' => $collection,
                'filter' => $filter,
                'update' => $update,
                'options' => $options,
            ]),
        ]);
    }

    public function findOneAndReplace($collection, $filter, $replacement, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'findOneAndReplace',
                'collection' => $collection,
                'filter' => $filter,
                'replacement' => $replacement,
                'options' => $options,
            ]),
        ]);
    }

    public function replaceOne($collection, $filter, $doc, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'replaceOne',
                'collection' => $collection,
                'doc' => $doc,
                'filter' => $filter,
                'options' => $options,
            ]),
        ]);
    }


    public function select($collection, $doc, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'insertOne',
                'collection' => $collection,
                'doc' => $doc,
                'options' => $options,
            ]),
        ]);
    }

    public function findOne($collection, $query, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'findOne',
                'collection' => $collection,
                'query' => $query,
                'options' => $options,
            ]),
        ]);
    }

    public function find($collection, $query, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'find',
                'collection' => $collection,
                'query' => $query,
                'options' => $options,
            ]),
        ]);
    }

    public function aggregate($collection, $pipeline, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'aggregate',
                'collection' => $collection,
                'pipeline' => $pipeline,
                'options' => $options,
            ]),
        ]);
    }

    public function count($collection, $query, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'count',
                'collection' => $collection,
                'query' => $query,
                'options' => $options,
            ]),
        ]);
    }

    public function distinct($collection, $query, $key, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'distinct',
                'collection' => $collection,
                'query' => $query,
                'key' => $key,
                'options' => $options,
            ]),
        ]);
    }

    /**
     * 创建索引
     * @param $collection
     * @param $field
     * @param array $options
     * @return string
     * @throws \xin\serverless\ServerlessException
     */
    public function createIndex($collection, $field, $options = [])
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'createIndex',
                'collection' => $collection,
                'field' => $field,
                'options' => $options,
            ]),
        ]);
    }

    /**
     * 查询索引
     * @param $collection
     * @return string
     * @throws \xin\serverless\ServerlessException
     */
    public function listIndex($collection)
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
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
     * @throws \xin\serverless\ServerlessException
     */
    public function dropIndex($collection, $indexName)
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'dropIndex',
                'indexName' => $indexName,
                'collection' => $collection,
            ]),
        ]);
    }

    /**
     * 创建集合
     * @param $collection
     * @param $name
     * @return string
     * @throws \xin\serverless\ServerlessException
     */
    public function createCollection($collection, $name)
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'createCollection',
                'name' => $name,
                'collection' => $collection,
            ]),
        ]);
    }

    /**
     * 查询集合
     * @param $collection
     * @return string
     * @throws \xin\serverless\ServerlessException
     */
    public function findCollection($collection)
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
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
     * @throws \xin\serverless\ServerlessException
     */
    public function dropCollection($collection)
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'drop',
                'collection' => $collection,
            ]),
        ]);
    }

    /**
     * 重命名集合
     * @param $collection
     * @param $name
     * @return string
     * @throws \xin\serverless\ServerlessException
     */
    public function renameCollection($collection, $name)
    {
        return $this->serverless->request([
            'method' => self::ISVEXECUTE,
            'params' => json_encode([
                'command' => 'rename',
                'newName' => $name,
                'collection' => $collection,
            ]),
        ]);
    }
}
