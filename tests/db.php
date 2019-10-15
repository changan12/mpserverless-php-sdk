<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<liuxingwu@duoguan.com>
 * @date: 2019/10/15 11:08
 */

use xin\serverless\Serverless;

require_once '../vendor/autoload.php';

$serverless = new Serverless();
//$res = $serverless->db->insertMany('test-duoguan', [['bbb'=>'bbbbbbbbbb','aaa'=>'aaaaaaaaaa']], []);
//$res = $serverless->db->find('test-duoguan', [], []);
//$res = $serverless->db->updateMany('test-duoguan', ['bbb'=>'2222222222222'], ['$set'=>['bbb'=>'2222222222222','ccc'=>'333333333333']]);



$res = $serverless->db->listIndexes('test-duoguan');
var_dump($res);
