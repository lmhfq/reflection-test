<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\CustomerMapper;
use yii\console\Controller;


/**
 * This command echoes the first argument that you have entered.
 * This command is provided as an example for you to learn how to create console commands.
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return void Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        CustomerMapper::createIndex();

        $time = time();
        $faker = \Faker\Factory::create(str_replace('-', '_', 'Zh-cn'));
        for ($i = 0; $i < 100; $i++) {
            $mapper = new CustomerMapper();
            $mapper->primaryKey = time() . '-' . $i;
            $mapper->customer_id = $i;
            $mapper->staff_id = 1;
            $mapper->customer_name = $faker->name;
            $mapper->company_name = $faker->company;
            $mapper->tel = $faker->phoneNumber;
            $mapper->address = $faker->address;
            $mapper->status = 1;
            $mapper->create_time = $time;
            $result = $mapper->save();
            $time += 43200;
            $this->stdout('插入----' . $i . "\n");
        }
    }
}
