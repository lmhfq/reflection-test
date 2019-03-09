<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 */

namespace app\commands;


use app\components\drivers\AnnotationDriver;

use app\services\UserService;
use ReflectionClass;
use yii\console\Controller;

class AnTestController extends Controller
{
    public function actionTest()
    {
        try {
            $driver = new AnnotationDriver();
            $driver->loadMetadataForClass(new ReflectionClass(UserService::class));
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}