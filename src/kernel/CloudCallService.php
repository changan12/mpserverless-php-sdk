<?php
/**
 * Created by PhpStorm.
 * User: 1458790210@qq.com
 * Date: 2019/10/15
 * Time: 14:46
 */

namespace xin\serverless\kernel;

class CloudCallService
{

    /**
     * @var \xin\serverless\Serverless
     */
    protected $serverless;

    /**
     * CloudCallService constructor.
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
            'method' => 'serverless.function.isv.runtime.invoke',
            'params' => json_encode($params),
        ]);
    }

    public function invoke($functionTarget, $functionArgs)
    {
        return $this->request([
            'functionTarget' => $functionTarget,
            'functionArgs' => empty($functionArgs) ? new \stdClass() : $functionArgs,
        ]);
    }

}