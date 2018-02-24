<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "tbl_oauth_identity".
 *
 * @property integer $id
 * @property string $client_id
 * @property string $client_secret
 */
class TblOauthIdentity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_oauth_identity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['client_id', 'client_secret'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'client_secret' => 'Client Secret',
        ];
    }
}
