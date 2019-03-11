<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2019/3/9
 * Time: 18:01
 */

namespace app\components\factory\reflection;

use SmsMessage;

class SmsFactory extends MessageFactory
{
    public function getInstance()
    {
        return new SmsMessage();
    }
}