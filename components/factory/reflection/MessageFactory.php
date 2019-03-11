<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 */

namespace app\components\factory\reflection;


use MessageInterface;

abstract class MessageFactory
{
    /**
     * @author lmh
     * @return MessageInterface
     */
    abstract public function getInstance();
}