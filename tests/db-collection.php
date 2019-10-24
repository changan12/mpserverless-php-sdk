<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<657306123@qq.com>
 * @date: 2019/10/24 14:33
 */
use duoguan\aliyun\serverless\Serverless;

require_once '../vendor/autoload.php';

$serverless = new Serverless([
	'space_id'    => '655bc0ae-7dd0-4567-9083-4706bfea75e9',
	'private_key' => '-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDYE3X9+kfyhk+oU1HmwCVbA3kxsD6HdYRXEMd2RQknSrCFL5vchGiY5Q6jxiUOyCZ0fgSUHYDxIYTFtzAOkjnCIvFcbWt8jdCaRQnzpK+jNNRvbkPldPe3pth74gvMAzvezMOQO4dyQ7rg6Ni49d61sZY25Kkb7gDWR8fJ70MWaqURJmsf7r770m2ejVtAcbOAnkr6aevLpL/24la2DYmafw63vHyqvy4DbUw0fOmyciOj4Xd6CSPGaV3ipTvRhMxe81Cbhzi62PtKfu2Rm5cx6iXMfaj/1oxjmOle23TBfhXHhQ63TJwXIkftebRCL/4JYcZJdPy4nbkE7TtCWVkxAgMBAAECggEBAIedp0fRx0hrjiF6sgPfA1MdWfqawJQqaPZwXJBZggY8NZBSMkP0guW7ljWqTmX5r1EcKul/nwc432lssWfj1QaJAe3d60GQjKXWwQk/itEnflG15j1k7XlB6cvPM1JHkVMkN3YWNsu7wNYarrNf9fkZzcsENzOFbNcQ1E9ksTmmbEARzeaGIabcK5AZBnmX/trovdCjnoF+RN+1Yk7A57s+Hart29Uo+SLY4x+a75wbgHjFAZxTJlOZR/Ow6Ktk74YK8aq9r0AVoqYP8kJ3uC8oET6H2MZbm6+jf3I8IX9+w+vWs0ncn2NLw7dyyw4yIUPyQ4TempUYMWSALEBb3AECgYEA8Xu/sezQSBRGa5RW/LgV9i5LT5t3Rl+tOQRtE2yPTy6TAuog0sodheED4cpyCseZd1Cb9kkIiJf1vhIxDJZHyCLfiodAq21YW4BXX6t2ZKg9af5anz7VNOfFn7+42LXj4gEZpeWKivmMUrDkTnT5fsmg8fF10OMRzZHOj4fvofECgYEA5RC2G2n/37MNDdUIhy6dnvgYYyronm6Lf/bYG5XM+uUsYy12YPkHlj+jYJcTrqVe0MHYYcWlEemtBBQWel/nmlHVGk6COZhhce3TO8GADagmlDf7pXUfk4W2s5guAb/VTmcP64nrFfbfkmvjCQy371s3Fu4vyCacoJrvg+lp60ECgYEA18OnU1XyAAVFqoffdW0SCmXw2o9hclq4jvJ6d1mPbsOBjaAeddkrqdyUuGFHpoQThn1a7SLyYgHNC+h7NPDt8E/ghok06jcINLGm4A92+JcuUI9470KYA+53MLaAdfmHRP+QqB9Bu80faR8uzz9LUdLcYHFLwLmyxYfbFXnzTjECgYAigvwM8VF90Ko81UXtqBZTZym1dzeI9zrJUtWIgm9ZtcGUR7s4LQz5lCj3Wou6mmvIpAwH3xFZu403uhcQ5PYuB/pFdmKkbtLvqVdT/3ldlWIKnsypRxY00caPFHSKCu8GWvzJDgR/UKyqkNqp+GKWC3YnXEeSrk6W3AEOLNKqgQKBgCafQ/BuWU0TIlaJZL9bFoBLyOt5dce9nCqhDPMkfN3NptqH8o7Y1Izqk/GsKZv+CFqaevL5lntdf5SGIuQvgyKUIgMQHHD0OB/pA9aB6jpOw91FFepqNIumYZCeZJJ7wH6DB9xb4AgLAkIFlkxzyoC+E0MWFhuDKqytZlUStU21
-----END PRIVATE KEY-----',
]);

/* ***********************************************
	第一版实现比较简单
 ************************************************/

$testModel = $serverless->db->collection('test');

// 查找数据
$data = $testModel->findAll();
var_dump($data);

// 新增数据
$data = $testModel->insert([
	'title'   => date('YmdHis').uniqid("tt"),
	'content' => '最好用的severless-sdk',
]);
var_dump($data);
