<?php
declare(strict_types=1);


namespace app\components\dependencies;

use ReflectionClass;

/**
 * Created by PhpStorm.
 * User: lmh
 */
class ClassFactory
{

    /**
     * @param string $class
     * @return object
     * @throws \ReflectionException
     */
    public static function make(string $class)
    {
        $reflector = new ReflectionClass($class);
        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $class;
        }

        $parameters = $constructor->getParameters();
        $instances = self::resolveDependencies($parameters);
        return $reflector->newInstanceArgs($instances);

    }

    /**
     * @param array $parameters
     * @return array
     * @throws \ReflectionException
     */
    public static function resolveDependencies(array $parameters)
    {
        $dependencies = [];
        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();
            if (is_null($dependency)) {
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    // //不是可选参数的为了简单直接赋值为字符串0
                    //                //针对构造方法的必须参数这个情况
                    //                //laravel是通过service provider注册closure到IocContainer,
                    //                //在closure里可以通过return new Class($param1, $param2)来返回类的实例
                    //                //然后在make时回调这个closure即可解析出对象
                    $dependencies[] = '6666';
                }

            } else {
                //递归解析出依赖类的对象
                $dependencies[] = self::make($parameter->getClass()->name);
            }
        }
        return $dependencies;
    }

}