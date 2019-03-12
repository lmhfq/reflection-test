<?php
declare(strict_types=1);

namespace app\components\decorator;
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 */
class Person implements Component
{
    public function display()
    {
        echo '----person';
    }
}