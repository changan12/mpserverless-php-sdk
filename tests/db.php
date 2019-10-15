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
$res = $serverless->db->updateOne('test-duoguan', ['_id' => '5da57bbae1b3c1005e053709'], ['bbb'=>'123']);
//$res = $serverless->db->listIndex('test-duoguan');
var_dump($res);
