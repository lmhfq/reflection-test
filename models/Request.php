<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh
 */

namespace app\models;


class Request
{

    public function get(string $name, $default = null)
    {
        return $_GET[$name] ?? $default;
    }
}