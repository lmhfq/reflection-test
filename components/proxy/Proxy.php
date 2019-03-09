<?php
declare(strict_types=1);

namespace app\components\proxy;
use ReflectionClass;

/**
 * Created by PhpStorm.
 * User: lmh
 */
class Proxy
{

    const CLASS_TEMPLATE = class_stub;      //这里显示上面定义的，为了方便阅读
    const FUNCTION_TEMPLATE = function_stub;    //同上

    /**
     * @param $target
     * @param array $interfaces
     * @param InvocationHandler $handler
     * @return mixed
     * @throws \ReflectionException
     */
    public static function newProxyInstance($target, array $interfaces, InvocationHandler $handler)  {
        self::checkInterfaceExists ($interfaces);
        $code = self::generateClass ($interfaces);
        return eval($code);
    }

    /**
     * @param array $interfaces
     * @return string
     * @throws \ReflectionException
     */
    protected static function generateClass(array $interfaces)
    {
        $interfaceList = implode(',', $interfaces);
        $functionList = '';
        foreach ($interfaces as $interface) {
            $class = new ReflectionClass ($interface);
            $methods = $class->getMethods();
            foreach ($methods as $method){
                $parameters = [];
                foreach ($method->getParameters() as $parameter){
                    $parameters[] = '$' . $parameter->getName();
                }
                $functionList .= sprintf( self::FUNCTION_TEMPLATE, $method->getName(), implode( ',', $parameters ) );
            }
        }
        return sprintf ( self::CLASS_TEMPLATE, $interfaceList, $functionList );
    }
    protected static function checkInterfaceExists(array $interfaces)  {

    }


}