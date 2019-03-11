<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 */

namespace app\components\proxy;


class Student implements Person
{
    // 姓名
    private $name;

    /**
     * RealSubject constructor. 构造方法
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * 说话
     */
    public function say()
    {
        echo $this->name . "在说话<br>";
    }
}