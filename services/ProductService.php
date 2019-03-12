<?php
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 */

namespace app\services;


interface ProductService
{
    const APP = '_cms/api/';

    public function list(): array;
}