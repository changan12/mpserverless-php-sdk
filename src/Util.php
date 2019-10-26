<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<657306123@qq.com>
 * @date: 2019/10/26 14:56
 */

namespace duoguan\aliyun\serverless;

final class Util{

	/**
	 * 把对象转换成字符串
	 *
	 * @param array  $data
	 * @param string $prefix
	 * @return string
	 */
	public static function buildUrlQuery(array $data, $prefix = ''){
		ksort($data);
		$str = '';
		$i = 0;
		foreach($data as $key => $val){
			if($i > 0) $str .= "&";

			if(is_array($val)){
				$str .= self::buildUrlQuery($val, $prefix.$key.".");
			}else{
				$str .= "{$prefix}{$key}={$val}";
			}
			$i++;
		}
		return $str;
	}
}
