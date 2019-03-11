<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 */

namespace app\components\proxy;


class Proxy implements Person
{
    /**
     * @var Person
     */
    private $obj = null;

    /**
     * Proxy constructor.
     * @param Student $obj
     */
    public function __construct(Student $obj)
    {
        $this->obj = $obj;
    }

    /**
     * 调用说话方法
     */
    public function say()
    {
        echo '----------';
        $this->obj->say();
    }

}