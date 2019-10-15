<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<liuxingwu@duoguan.com>
 * @date: 2019/10/14 18:42
 */

namespace xin\serverless;

use GuzzleHttp\Client;
use xin\container\ProviderContainer;
use xin\helper\Str;
use xin\helper\Time;
use xin\serverless\providers\CloudCallServiceProvider;
use xin\serverless\providers\DbServiceProvider;

/**
 * @property \xin\serverless\kernel\DbService db
 */
class Serverless extends ProviderContainer{

	/**
	 * @var array
	 */
	protected $providers
		= [
			DbServiceProvider::class,
			CloudCallServiceProvider::class,
		];

	/**
	 * @var \GuzzleHttp\Client
	 */
	protected $httpClient;

	/**
	 * 私有密码
	 *
	 * @var string
	 */
	protected $privateKey = '-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDYE3X9+kfyhk+oU1HmwCVbA3kxsD6HdYRXEMd2RQknSrCFL5vchGiY5Q6jxiUOyCZ0fgSUHYDxIYTFtzAOkjnCIvFcbWt8jdCaRQnzpK+jNNRvbkPldPe3pth74gvMAzvezMOQO4dyQ7rg6Ni49d61sZY25Kkb7gDWR8fJ70MWaqURJmsf7r770m2ejVtAcbOAnkr6aevLpL/24la2DYmafw63vHyqvy4DbUw0fOmyciOj4Xd6CSPGaV3ipTvRhMxe81Cbhzi62PtKfu2Rm5cx6iXMfaj/1oxjmOle23TBfhXHhQ63TJwXIkftebRCL/4JYcZJdPy4nbkE7TtCWVkxAgMBAAECggEBAIedp0fRx0hrjiF6sgPfA1MdWfqawJQqaPZwXJBZggY8NZBSMkP0guW7ljWqTmX5r1EcKul/nwc432lssWfj1QaJAe3d60GQjKXWwQk/itEnflG15j1k7XlB6cvPM1JHkVMkN3YWNsu7wNYarrNf9fkZzcsENzOFbNcQ1E9ksTmmbEARzeaGIabcK5AZBnmX/trovdCjnoF+RN+1Yk7A57s+Hart29Uo+SLY4x+a75wbgHjFAZxTJlOZR/Ow6Ktk74YK8aq9r0AVoqYP8kJ3uC8oET6H2MZbm6+jf3I8IX9+w+vWs0ncn2NLw7dyyw4yIUPyQ4TempUYMWSALEBb3AECgYEA8Xu/sezQSBRGa5RW/LgV9i5LT5t3Rl+tOQRtE2yPTy6TAuog0sodheED4cpyCseZd1Cb9kkIiJf1vhIxDJZHyCLfiodAq21YW4BXX6t2ZKg9af5anz7VNOfFn7+42LXj4gEZpeWKivmMUrDkTnT5fsmg8fF10OMRzZHOj4fvofECgYEA5RC2G2n/37MNDdUIhy6dnvgYYyronm6Lf/bYG5XM+uUsYy12YPkHlj+jYJcTrqVe0MHYYcWlEemtBBQWel/nmlHVGk6COZhhce3TO8GADagmlDf7pXUfk4W2s5guAb/VTmcP64nrFfbfkmvjCQy371s3Fu4vyCacoJrvg+lp60ECgYEA18OnU1XyAAVFqoffdW0SCmXw2o9hclq4jvJ6d1mPbsOBjaAeddkrqdyUuGFHpoQThn1a7SLyYgHNC+h7NPDt8E/ghok06jcINLGm4A92+JcuUI9470KYA+53MLaAdfmHRP+QqB9Bu80faR8uzz9LUdLcYHFLwLmyxYfbFXnzTjECgYAigvwM8VF90Ko81UXtqBZTZym1dzeI9zrJUtWIgm9ZtcGUR7s4LQz5lCj3Wou6mmvIpAwH3xFZu403uhcQ5PYuB/pFdmKkbtLvqVdT/3ldlWIKnsypRxY00caPFHSKCu8GWvzJDgR/UKyqkNqp+GKWC3YnXEeSrk6W3AEOLNKqgQKBgCafQ/BuWU0TIlaJZL9bFoBLyOt5dce9nCqhDPMkfN3NptqH8o7Y1Izqk/GsKZv+CFqaevL5lntdf5SGIuQvgyKUIgMQHHD0OB/pA9aB6jpOw91FFepqNIumYZCeZJJ7wH6DB9xb4AgLAkIFlkxzyoC+E0MWFhuDKqytZlUStU21
-----END PRIVATE KEY-----';

	/**
	 * Serverless constructor.
	 *
	 * @param array $clientConfig
	 */
	public function __construct($clientConfig = []){
		$this->httpClient = new Client(array_merge([
//			'base_uri' => 'https://api.bspapp.com/server',
			'base_uri' => 'http://39.98.106.113/server',
			'timeout'  => 2.0,
		], $clientConfig));

		$this->registerProviders();
	}

	/**
	 * 请求
	 *
	 * @param array $data
	 * @return string
	 * @throws \xin\serverless\ServerlessException
	 */
	public function request(array $data){
		$data["spaceId"] = '655bc0ae-7dd0-4567-9083-4706bfea75e9'; // serverless spaceId
		$data["timestamp"] = Time::getMillisecond(); // 毫秒级别时间戳

		$sign = self::makeSign($data, $this->privateKey);
		$options = [
			'debug'       => true,
			'headers'     => [
				'X-Serverless-Sign' => $sign,
			],
			'form_params' => $data,
		];

		echo http_build_query($data)."\n";

		$response = $this->httpClient->post('', $options);

		return $response->getBody()->getContents();
	}

	/**
	 * 制作签名
	 *
	 * @param array  $data
	 * @param string $privateKey
	 * @return string
	 * @throws \xin\serverless\ServerlessException
	 */
	public static function makeSign($data, $privateKey){
		ksort($data);
		$dataStr = Str::buildUrlQuery($data, function($key, $val){
			return $key.'='.$val;
		});

		$pkId = openssl_get_privatekey($privateKey);
		if(!$pkId){
			throw new ServerlessException("不是一个正确的私钥！");
		}

		$verify = openssl_sign($dataStr, $signData, $pkId, OPENSSL_ALGO_SHA256);
		if(!$verify){
			openssl_free_key($pkId);
			throw new ServerlessException("签名生成失败：".openssl_error_string());
		}

		openssl_free_key($pkId);

		return bin2hex($signData);
	}
}
