<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 */

namespace app\components\annotations;

use Doctrine\Annotations\Annotation;
use Doctrine\Annotations\Annotation\Target;

/**
 * Class Logger
 * @Annotation
 * @Target({"CLASS","PROPERTY","METHOD"})
 * @package app\components\annotations
 * User: lmh <lmh@weiyian.com>
 */
final class Logger
{
    public $value;

    public function logger()
    {
        echo $this->value . "--------";
    }
}