<?php

namespace app\components\proxy;

use ReflectionClass;

/**
 * Created by PhpStorm.
 * User: lmh
 */
class Client
{
    private $service;

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
     * @throws \ReflectionException
     */
    public function __call($action, $arguments)
    {
        $ref = new ReflectionClass($this->service);
        if ($ref->hasMethod($action)) {
            $method = $ref->getMethod($action);
            if ($method->isPublic() && !$method->isAbstract() && count($arguments)) {
                if ($method->isStatic()) {
                    $method->invoke(null, $arguments);
                } else {
                    $method->invoke($this->service, $arguments);
                }
            }
        }
    }

}
