<?php

namespace app\components\proxy;

use ReflectionClass;
use yii\base\UserException;

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
     * @return mixed
     * @throws \ReflectionException
     * @throws UserException
     *
     */
    public function __call($action, $arguments)
    {
        $ref = new ReflectionClass($this->service);
        if (!$ref->hasMethod($action)) {
            throw new UserException('方法不存在');
        }
        $method = $ref->getMethod($action);
        if (!$method->isPublic() && (!$method->isAbstract() && count($arguments))) {
            throw new UserException('方法不存在');
        }
        //执行之前增加日志
        echo "------" . time();
        if ($method->isStatic()) {
            return $method->invoke(null, ...$arguments);
        } else {
            return $method->invoke($ref->newInstance(), ...$arguments);
        }

    }

}
