<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh
 */

namespace app\controllers;


use app\components\annotations\Logger;
use app\components\dependencies\ClassFactory;
use app\components\factory\MessageFactory;
use app\components\proxy\Client;
use app\components\strategy\AStrategy;
use app\components\strategy\Context;
use app\models\Circle;
use app\models\User;
use app\services\UserService;
use EmailMessage;
use ReflectionClass;
use SmsMessage;
use yii\base\Module;
use yii\base\UserException;
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
        var_dump(\Yii::$app->controller->action->id);

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
     * @throws UserException
     */
    public function actionStrategy()
    {
//        if(a){
//            //dosomething
//        }else if(b){
//            //doshomething
//        }else if(c){
//            //doshomething
//        } else{
//            ////doshomething
//        }

        $a = 'A';
        if ($a == 'a') {
            $strategy = new AStrategy();
        } elseif ($a == 'b') {
            $strategy = new AStrategy();
        } else {
            throw new UserException('暂无');
        }
        $strategy->show();

    }

    /**
     * 反射改造策略模式应用
     * @throws UserException
     */
    public function actionStrategyReflection()
    {
        $a = 'A';
        $strategy = Context::getInstance($a);
        $strategy->show();
    }

    /**
     * 反射注解应用
     * @Logger("我是日志")
     */
    public function actionAnnotation()
    {

    }

    /**
     * 反射依赖注入应用
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

    /**
     * @author lmh
     */
    public function actionRequest()
    {
        /**
         * @var $userService UserService
         */
        $userService = new Client(UserService::class);
        var_export($userService->getUserInfo(104));
    }

    /**
     * 发送消息普通方式
     * @author lmh
     * @throws UserException
     */
    public function actionMessage()
    {
        $mes_type = 'Sms';

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
        $obj->send();
    }

    /**
     * 发送消息-工厂方式改造
     * @author lmh
     * @throws \yii\base\UserException
     */
    public function actionFactory()
    {
        $obj = MessageFactory::getInstance('sms');
        $obj->send();
    }

    /**
     * 利用反射-改造工厂方式
     * @author lmh
     */
    public function actionFactoryReflection()
    {
        try {
            $obj = MessageFactory::geReflection('sms');
            $obj->send();
        } catch (\ReflectionException $e) {
        }
    }
}