<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 */

namespace app\components\proxy;


use yii\base\UserException;

class Request
{
    private $url;
    private $service;

    private $gataway='http://oa2.ruishan666.com/';
    /**
     * Client constructor.
     * @param $service
     * @throws UserException
     */
    public function __construct($service)
    {
        if (array_key_exists($service, $this->config)) {
            $this->url = $this->config[$service];
            $this->service = $service;
        } else {
            throw new UserException('请求方法不存在');
        }
    }

    /**
     * @author lmh
     * @param $action
     * @param $arguments
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __call($action, $arguments)
    {
        $client = new \GuzzleHttp\Client();
        $headers = [];
        $url = $this->url . '/' . $this->service . '/' . $action . 'json';
        $response = $client->request('GET', $url,
            ['headers' => $headers, 'query' => $arguments]);
        $content = $response->getBody()->getContents();
        return json_decode($content, true);
    }
}