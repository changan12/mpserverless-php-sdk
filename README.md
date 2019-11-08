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
$res = $db->insertOne('test', [
	'title'   => '最好用的severless-sdk',
	'content' => '最好用的severless-sdk',
]);
$newInsertedId = $res['data']['result']['insertedId'];
var_dump($newInsertedId);

// 查询数据
$res = $db->findOne('test', [
	'_id' => $newInsertedId,
]);
var_dump($res);

$res = $db->find('test');
var_dump($res);

// 更新数据
$insertedId = $res['data']['result'][0]['_id'];
$res = $db->updateOne('test', [
	'_id' => $newInsertedId,
], [
	'$set' => [
		'update_at' => time(),
	],
]);
var_dump($res);

// 查询数据
$res = $db->findOne('test', [
	'_id' => $newInsertedId,
]);
var_dump($res);

// 删除数据
$res = $db->deleteOne('test', [
	'_id' => $insertedId,
]);
var_dump($res);
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
