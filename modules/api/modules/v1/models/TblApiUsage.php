<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "tbl_api_usage".
 *
 * @property integer $id
 * @property string $access_token
 * @property string $method_name
 * @property string $sender_ip
 * @property string $received_data
 * @property string $request_date
 * @property string $response_data
 * @property string $response_date
 */
class TblApiUsage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_api_usage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['received_data', 'response_data'], 'string'],
            [['request_date', 'response_date'], 'safe'],
            [['access_token'], 'string', 'max' => 250],
            [['method_name'], 'string', 'max' => 150],
            [['sender_ip'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'access_token' => 'Access Token',
            'method_name' => 'Method Name',
            'sender_ip' => 'Sender Ip',
            'received_data' => 'Received Data',
            'request_date' => 'Request Date',
            'response_data' => 'Response Data',
            'response_date' => 'Response Date',
        ];
    }
}
