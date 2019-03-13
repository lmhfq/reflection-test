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

    /**
     * @var Point
     */
    public $center;

    const PI = 3.14;

    public function __construct(Request $request, Point $point)
    {
        $this->radius = $request->get('radius');
        $this->center = $point;
    }

    /**
     * 打印圆点的坐标
     * @author lmh
     */
    public function printCenter()
    {
        printf('center coordinate is (%d, %d)', $this->center->x, $this->center->y);
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