<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh
 */

namespace app\controllers;


use app\components\dependencies\ClassFactory;
use app\components\factory\MessageFactory;
use app\components\proxy\Client;
use app\models\Circle;
use app\models\User;
use app\services\UserService;
use ReflectionClass;
use yii\base\Module;
use yii\web\Controller;

class IndexController extends Controller
{


    /**
     * IndexController constructor.
     * @param string $id
     * @param Module $module
     * @param array $config
     * @throws \ReflectionException
     */
    public function __construct(string $id, Module $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $res = new ReflectionClass(IndexController::class);
    }


    /**
     * 基础概念
     * @throws \ReflectionException
     */
    public function actionReflection()
    {
        $user = new User();
        $ref = new ReflectionClass(User::class);
        var_dump($ref->getMethods());

        $method = $ref->getMethod('setName');
        $method->invoke($user, 'zhangshan');

        $method = $ref->getMethod('getName');
        $method->setAccessible(true);
        $data = $method->invoke($user);
        var_dump($data);

    }


    /**
     * 策略模式理解
     */
    public function actionStrategy()
    {


    }

    /**
     * 反射改造策略模式应用
     */
    public function actionStrategyReflection()
    {


    }

    /**
     * 反射注解应用
     */
    public function actionAnnotation()
    {

    }

    /**
     * 反射代理应用
     *
     * @throws \ReflectionException
     */
    public function actionDependencies()
    {
        /**
         * @var Circle $circle
         */
        $circle = ClassFactory::make(Circle::class);
        $area = $circle->area();
        var_dump($area);


    }

    public function actionRequest(){
        /**
         * @var $userService UserService
         */
        $userService = new Client(UserService::class);
        var_export($userService->getUserInfo(104));
    }

    /**
     * @author lmh
     * @throws \yii\base\UserException
     */
    public function actionFactory()
    {
        $obj=MessageFactory::getInstance('sms');
        $obj->send();
    }

    public function actionFactoryReflection(){

    }
}