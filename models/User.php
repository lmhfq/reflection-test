<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh
 */

namespace app\models;


class User
{
    private $name;

    public function setName($name)
    {
        $this->name = $name;
    }

    private function getName()
    {
        return $this->name;
    }
}