<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2019/3/11
 * Time: 9:55
 */

namespace app\components\strategy;


use yii\base\UserException;

class Context
{
    /**
     * @author lmh
     * @param $name
     * @return StrategyInterface
     * @throws UserException
     */
    public static function getInstance($name)
    {
        try {
            $reflect = new \ReflectionClass($name);
            /** @var StrategyInterface $instance */
            $instance = $reflect->newInstance();
            return $instance;
        } catch (\ReflectionException $e) {
            throw new UserException('不存在:' . $name);
        }
    }
}