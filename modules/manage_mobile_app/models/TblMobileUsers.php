<?php

namespace app\modules\manage_mobile_app\models;

use Yii;

/**
 * This is the model class for table "tbl_mobile_users".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $mobile_unique_code
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
            [['id'], 'required'],
            [['id', 'user_id'], 'integer'],
            [['mobile_unique_code'], 'string', 'max' => 250],
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
        ];
    }
}
