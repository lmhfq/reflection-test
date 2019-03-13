<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>¬
 */

namespace app\components\strategy;


use yii\base\UserException;

class Context
{
    /**
     * @var StrategyInterface
     */
    private $strategy;

    public function setStrategy(StrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @author lmh
     */
    public function show()
    {
        return $this->strategy->show();
    }

























    /***********************************************************************************
    */

    public static $command = [
        'A' => AStrategy::class,
        'B' => BStrategy::class,
    ];

    /**
     * @author lmh
     * @param $name
     * @return StrategyInterface
     * @throws UserException
     */
    public static function getInstance($name)
    {
        try {
//            if (!self::$command[$name]) {
//                throw new UserException('不存在:' . $name);
//            }
//            $name = self::$command[$name];

            $reflect = new \ReflectionClass($name);
            /** @var StrategyInterface $instance */
            $instance = $reflect->newInstance();

            return $instance;
        } catch (\ReflectionException $e) {
            throw new UserException('不存在:' . $name);
        }
    }
}