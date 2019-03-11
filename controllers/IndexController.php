<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh
 */

namespace app\controllers;


use app\components\annotations\Logger;
use app\components\dependencies\ClassFactory;
use app\components\drivers\AnnotationDriver;
use app\components\factory\MessageFactory;
use app\components\strategy\AStrategy;
use app\components\strategy\BStrategy;
use app\components\strategy\Context;
use app\models\Circle;
use app\models\Point;
use app\models\Request;
use app\models\User;
use app\services\UserService;
use Doctrine\Annotations\AnnotationException;
use EmailMessage;
use ReflectionClass;
use SmsMessage;
use yii\base\UserException;
use yii\web\Controller;

class IndexController extends Controller
{
    /**
     * @param $action
     * @return bool
     * @throws \ReflectionException
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        try {
            $driver = new AnnotationDriver();
            $driver->loadMetadataForMethod(IndexController::class, $action->actionMethod);
        } catch (AnnotationException $e) {
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub

    }


    /**
     * 基础概念
     * @throws \ReflectionException
     */
    public function actionReflection()
    {
        $user = new User();
        $ref = new ReflectionClass(User::class);

        $method = $ref->getMethod('setName');
        $method->invoke($user, 'zhangshan');

        //执行私有方法
        $method = $ref->getMethod('getName');
        $method->setAccessible(true);
        $data = $method->invoke($user);

        var_dump($data);


        $m = new \ReflectionMethod(User::class, 'getName');


        var_dump($m);

    }


    /**
     * 策略模式理解
     * @throws UserException
     */
    public function actionStrategy()
    {
//        if($a == 'a'){
//            //dosomething
//        }else if($a == 'b'){
//            //doshomething
//        }else if($a == 'c'){
//            //doshomething
//        } else{
//            ////doshomething
//        }

        $a = 'A';
        $context = new Context();
        if ($a == 'A') {
            $context->setStrategy(new AStrategy());
        } elseif ($a == 'B') {
            $context->setStrategy(new BStrategy());
        } else {
            throw new UserException('暂无');
        }
        echo $context->show();

    }

    /**
     * 反射改造策略模式应用
     * @throws UserException
     */
    public function actionStrategyReflection()
    {
        $a = 'A';
        $strategy = Context::getInstance('app\\components\\strategy\\' . $a . 'Strategy');
        //$strategy = Context::getInstance($a);
        echo $strategy->show();
    }


    /**
     * 依赖注入应用
     * @throws \ReflectionException
     */
    public function actionDependencies()
    {

        $circle = new Circle(new Request(),new Point());

        /**
         * @var Circle $circle
         */
        $circle = ClassFactory::make(Circle::class);
        $area = $circle->area();
        var_dump($area);
    }

    /**
     * 反射注解应用
     * @Logger("我是日志")
     */
    public function actionAnnotation()
    {
        var_dump('dsd');
    }

    /**
     * 代理模式-动态代理
     * @author lmh
     */
    public function actionRequest()
    {
        /**
         * @var $userService UserService
         */
        $userService = new \app\components\proxy\Client(UserService::class);
        var_dump($userService->getUserInfo(104));
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