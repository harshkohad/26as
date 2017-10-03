<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "tbl_oauth_access_tokens".
 *
 * @property integer $id
 * @property string $access_token
 * @property string $client_id
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
            [['id'], 'integer'],
            [['access_token', 'client_id'], 'string', 'max' => 250],
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
            'client_id' => 'Client ID',
            'expires' => 'Expires',
        ];
    }
}
