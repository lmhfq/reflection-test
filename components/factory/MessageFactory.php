<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 */

namespace app\components\factory;


use EmailMessage;
use MessageInterface;
use ReflectionClass;
use SmsMessage;
use yii\base\UserException;

class MessageFactory
{
    /**
     * @author lmh
     * @param $mes_type
     * @return MessageInterface
     * @throws UserException
     */
    public static function getInstance($mes_type)
    {
        switch ($mes_type) {
            case 'Sms':
                $obj = new SmsMessage();
                break;
            case 'Email':
                $obj = new EmailMessage();
                break;
            default:
                throw new UserException('NO Message Type Found');
        }
        return $obj;
    }

    /**
     * @author lmh
     * @param $mes_type
     * @return MessageInterface
     * @throws \ReflectionException
     */
    public static function geReflection($mes_type)
    {
        $reflection = new ReflectionClass($mes_type . 'Factory');
        /**
         * @var \app\components\factory\reflection\MessageFactory $factory
         */
        $factory = $reflection->newInstance();
        return $factory->getInstance();
    }
}