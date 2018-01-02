<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "tbl_oauth_access_tokens".
 *
 * @property integer $id
 * @property string $access_token
 * @property string $mobile_unique_code
 * @property string $expires
 */
class TblOauthAccessTokens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_oauth_access_tokens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'user_id'], 'integer'],
            [['access_token', 'mobile_unique_code'], 'string', 'max' => 250],
            [['expires'], 'string', 'max' => 45],
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
            'mobile_unique_code' => 'Mobile Unique Code',
            'expires' => 'Expires',
            'user_id' => 'User ID',
        ];
    }
}
