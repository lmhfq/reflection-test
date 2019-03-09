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

    private $gataway = 'https://oa2.ruishan666.com/_sale/';

    /**
     * Client constructor.
     * @param $service
     */
    public function __construct($service)
    {
        $this->service = $service;
    }

    public function __call($action, $arguments)
    {



    }

}
