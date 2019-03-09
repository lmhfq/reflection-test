<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh
 */

namespace app\components\proxy;


interface InvocationHandler
{
    function invoke($method, array $arr_args);
}
