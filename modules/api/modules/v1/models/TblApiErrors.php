<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "tbl_api_errors".
 *
 * @property integer $id
 * @property string $code
 * @property string $message
 */
class TblApiErrors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_api_errors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'string', 'max' => 45],
            [['message'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'message' => 'Message',
        ];
    }
}
