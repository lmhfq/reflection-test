<?php
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 */

namespace app\services;


interface ProductService
{
    const APP = '_cms';

    public function list();
}