<?php
declare(strict_types=1);

namespace app\services;

use app\components\annotations\Logger;

/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 */
class UserService
{
    /**
     * @author lmh
     * @Logger("我是日志")
     * @param int $id
     * @return array
     */
    public function getUserInfo(int $id): array
    {
        return [$id . '员工'];
    }
}