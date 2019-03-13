<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh
 */

namespace app\models;

class Circle
{
    /**
     * @var int
     */
    public $radius;

    const PI = 3.14;

    public function __construct(Request $request)
    {
        $this->radius = $request->get('radius');
    }

    /**
     * 计算圆形的面积
     * @author lmh
     * @return float
     */
    public function area()
    {
        return 3.14 * pow($this->radius, 2);
    }
}