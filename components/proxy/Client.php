<?php

namespace app\components\proxy;

/**
 * Created by PhpStorm.
 * User: lmh
 */

class Client
{
    private $url;
    private $service;

    private $config = [
        "UserService" => "http://192.168.10.33/test/server/index.php",
    ];

    /**
     * Client constructor.
     * @param $service
     */
    public function __construct($service)
    {
        if (array_key_exists($service, $this->config)) {
            $this->url = $this->config[$service];
            $this->service = $service;
        }
    }

    public function __call($action, $arguments)
    {
        $content = json_encode($arguments);
        $options['http'] = [
            'timeout' => 5,
            'method' => 'POST',
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => $content,
        ];
        $context = stream_context_create($options);
        $get = [
            'service' => $this->service,
            'action' => $action,
        ];
        $url = $this->url . "?" . http_build_query($get);
        $res = file_get_contents($url, false, $context);
        $this->client = new Client(
            [
                'timeout' => 8.0
            ]
        );
        return json_decode($res, true);
    }

}
