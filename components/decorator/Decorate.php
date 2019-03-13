<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 */

namespace app\components\decorator;


abstract class Decorate implements Component
{
    protected $component;

    /**
     * 构造注入原组件
     * @param Component $component
     */
    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    public function display()
    {
        if (!is_null($this->component)) {
            $this->component->display();
        }
    }
}