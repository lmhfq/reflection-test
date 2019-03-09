<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh
 */

namespace app\models;


/**
 * Class Point
 */
class Point
{
    public $x;
    public $y;

    /**
     * Point constructor.
     * @param int $x horizontal value of point's coordinate
     * @param int $y vertical value of point's coordinate
     */
    public function __construct($x = 0, $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
    }

}