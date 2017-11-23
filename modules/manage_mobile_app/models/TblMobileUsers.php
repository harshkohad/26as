<?php

namespace app\modules\manage_mobile_app\models;

use Yii;

/**
 * This is the model class for table "tbl_mobile_users".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $mobile_unique_code
 * @property string $field_agent_name
 */
class TblMobileUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_mobile_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['mobile_unique_code'], 'string', 'max' => 250],
            [['field_agent_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'mobile_unique_code' => 'Mobile Unique Code',
            'field_agent_name' => 'Field Agent Name',
        ];
    }
}
