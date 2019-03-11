<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 */

namespace app\components\factory\reflection;


use EmailMessage;

class EmailFactory extends MessageFactory
{

    public function getInstance()
    {
        return new EmailMessage();
    }
}
