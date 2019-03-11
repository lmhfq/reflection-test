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

        $dependencies  = $constructor->getParameters();
        $instances = self::resolveDependencies($dependencies);
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
                    //有默认值的 暂不说明 具体可以参考 yii  laravel的底层
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