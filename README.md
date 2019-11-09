# 阿里云 Serverless SDK

基于阿里云serverless服务面接口封装的sdk，它以简洁而优雅的使用方式会让你的开发效率更高。

## 使用方法：

**云数据调用**
```php
<?php
use duoguan\aliyun\serverless\logger\PrintLogger;
use duoguan\aliyun\serverless\Serverless;

// 初始化serverless实例
$serverless = new Serverless([
	'space_id'      => 'SpaceId',
	'private_key'   => 'SpacePrivateKey',
	'failException' => true,
]);

// 使用psr/log规范，可以使用你自己实现的Logger
$serverless->setLogger(new PrintLogger());

// 获取DB实例
$db = $serverless->db;

// 插入数据
$newInsertedId = $db->insertOne('test', [
	'title'   => '最好用的severless-sdk',
	'content' => '最好用的severless-sdk',
]);
var_dump("insert Id:".$newInsertedId);

// 插入多条数据
$newInsertedIds = $db->insertMany('test', [
	[
		'title'   => '最好用的severless-sdk',
		'content' => '最好用的severless-sdk',
	],
	[
		'title'   => '最好用的severless-sdk',
		'content' => '最好用的severless-sdk',
	],
]);
var_dump($newInsertedIds);

// 查询数据
$doc = $db->findOne('test', [
	'_id' => $newInsertedId,
]);
var_dump($doc);

// 获取所有数据
$docs = $db->find('test', [], [
	'page' => 1,
]);
var_dump($docs);

// 更新数据
$updateId = $docs[0]['_id'];
var_dump("update id:".$updateId);
$updateCount = $db->updateOne('test', [
	'_id' => $updateId,
], [
	'$set' => [
		'update_at' => time(),
	],
]);
var_dump("update ".($updateCount ? 'success' : 'empty'));

// 更新多条数据
$updateTotalCount = $db->updateMany('test', [
	'update_at' => null,
], [
	'$set' => [
		'update_at' => time(),
	],
]);
var_dump("update count:{$updateTotalCount}");

// 查找一条数据后更新
$info = $db->findOneAndUpdate('test', [
	'_id' => $updateId,
], [
	'$set' => [
		'name' => '小明',
		'uid'  => uniqid(),
	],
]);
var_dump($info);

// 查找一条数据后更新
$info = $db->findOneAndReplace('test', [
	'_id' => $updateId,
], [
	'name' => '小明',
	'uid'  => uniqid(),
]);
var_dump($info);

$info = $db->replaceOne('test', [
	'_id' => $updateId,
], [
	'name' => '小红',
	'uid'  => uniqid(),
]);
var_dump($info);

// 查找一条数据后删除
$info = $db->findOneAndDelete('test', [
	'_id' => $updateId,
]);
var_dump($info);

// 查找所有数据并返回总量
$result = $db->findAndTotalRows('test', [], [
	'limit' => 10,
]);
var_dump($result);

// 查找唯一值
$result = $db->distinct('test', 'update_at');
var_dump($result);

// 聚合查询
$result = $db->aggregate('test', [
	[
		'$group' => [
			'_id'          => '$update_at',
			'num_tutorial' => [
				'$sum' => '$likes',
			],
		],
	],
]);
var_dump($result);

// 删除数据
$deleteCount = $db->deleteOne('test', [
	'_id' => $newInsertedId,
]);
var_dump($deleteCount);

// 删除多条数据
//$deleteCount = $db->deleteMany('test');
//var_dump($deleteCount);
```

**云函数调用**
```php
<?php
use duoguan\aliyun\serverless\logger\PrintLogger;
use duoguan\aliyun\serverless\Serverless;
use duoguan\aliyun\serverless\ServerlessException;

$serverless = new Serverless([
	'space_id'      => 'SpaceId',
	'private_key'   => 'SpacePrivateKey',
	'failException' => true,
]);
$serverless->setLogger(new PrintLogger());

$func = $serverless->func;
try{
	$result = $func->invoke('hello', ['world']);
	var_dump($result);
}catch(ServerlessException $e){
	echo $e->getMessage();
}
```

**云储存调用**
```php
<?php
use duoguan\aliyun\serverless\logger\PrintLogger;
use duoguan\aliyun\serverless\Serverless;
use duoguan\aliyun\serverless\ServerlessException;

$serverless = new Serverless([
	'space_id'      => 'SpaceId',
	'private_key'   => 'SpacePrivateKey',
	'failException' => true,
]);
$serverless->setLogger(new PrintLogger());

try{
	$file = $serverless->file;
	$info = $file->putFile('public', "./000.jpg");
	var_dump($info);
}catch(ServerlessException $e){
	echo $e->getMessage();
}

try{
	$file = $serverless->file;
	$info = $file->putData('public', "./000.jpg", file_get_contents("./000.jpg"));
	var_dump($info);
}catch(ServerlessException $e){
	echo $e->getMessage();
}
```
