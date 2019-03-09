<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2019/3/9
 * Time: 17:48
 */

namespace app\components\factory;


use EmailMessage;
use MessageInterface;
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
    public static function getInstance($mes_type){
        switch ($mes_type){
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
}