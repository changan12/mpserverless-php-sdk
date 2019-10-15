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
$res = $serverless->db->find('test', [

]);
var_dump($res);
