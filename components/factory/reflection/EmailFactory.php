<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2019/3/9
 * Time: 18:00
 */

namespace app\components\factory\reflection;


use EmailMessage;

class EmailFactory extends MessageFactory {
    public function get_instance()
    {
        return new EmailMessage();
    }
}
