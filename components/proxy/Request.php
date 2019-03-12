<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 */

namespace app\components\proxy;


use ReflectionClass;
use yii\base\UserException;

class Request
{
    private $service;

    private $gateway = 'http://oa2.ruishan666.com/';

    /**
     * Client constructor.
     * @param $service
     */
    public function __construct($service)
    {
        $this->service = $service;
    }

    /**
     * @author lmh
     * @param $action
     * @param $arguments
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \ReflectionException
     * @throws UserException
     */
    public function __call($action, $arguments)
    {
        $ref = new ReflectionClass($this->service);
        if (!$ref->hasMethod($action)) {
            throw new UserException('方法不存在');
        }
        $client = new \GuzzleHttp\Client();
        $service = substr($ref->getShortName(), 0, -7);
        $app = $ref->getConstant('APP');
        $headers = [];
        $url = $this->gateway . $app . strtolower($service . '/' . $action . '.json');
        $response = $client->request('GET', $url, ['headers' => $headers, 'query' => $arguments]);
        $content = $response->getBody()->getContents();
        return json_decode($content, true);
    }
}