<?php

namespace app\models;

use Yii;

/**
 * Class CustomerMapper
 * @package common\models
 * @property int $customer_id
 * @property int $staff_id
 * @property string $company_name
 * @property string $customer_name
 * @property string $tel
 * @property string $address
 * @property int $status
 * @property int $create_time
 * User: lmh
 * Date: 2018/11/11
 */
Class CustomerMapper extends \yii\elasticsearch\ActiveRecord
{

    public function attributes()
    {
        return [
            'customer_id',
            'staff_id',
            'company_name',
            'customer_name',
            'tel',
            'address',
            'status',
            'create_time',
        ];
    }

    /**
     * @return array This model's mapping
     */
    public static function mapping()
    {
        return [
            static::type() => [
                'properties' => [
                    'customer_id' => ['type' => 'integer'],
                    'staff_id' => ['type' => 'integer'],
                    'company_name' => ['type' => 'keyword'],
                    'customer_name' => ['type' => 'keyword'],
                    'tel' => ['type' => 'keyword'],
                    'address' => ['type' => 'keyword'],
                    'status' => ['type' => 'integer'],
                    'create_time' => ['type' => 'integer']
                ]
            ],
        ];
    }

    /**
     * Set (update) mappings for this model
     */
    public static function updateMapping()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->setMapping(static::index(), static::type(), static::mapping());
    }

    /**
     * Create this model's index
     */
    public static function createIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->createIndex(static::index(), [
            'settings' => ['index' =>
                ['refresh_interval' => '1s', 'blocks' => ['read_only_allow_delete' => false]]
            ],
            'mappings' => static::mapping(),

        ]);
    }

    /**
     * Delete this model's index
     */
    public static function deleteIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->deleteIndex(static::index());
    }


}
