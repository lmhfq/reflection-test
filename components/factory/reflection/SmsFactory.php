<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
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