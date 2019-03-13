<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh
 * Date: 2019/3/11
 * Time: 下午9:18
 */

namespace app\components\annotations;

use app\components\decorator\Component;
use Doctrine\Annotations\Annotation;
use Doctrine\Annotations\Annotation\Target;
/**
 * Class Car
 * @Annotation
 * @Target({"METHOD"})
 * @package app\components\annotations
 */
final class Car implements Component
{

    public function display()
    {
        echo "<br/>i have a car";
    }
}