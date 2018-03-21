<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_settings".
 *
 * @property integer $id
 * @property string $app_name
 * @property string $app_name_short
 * @property string $app_mode
 * @property integer $audit_mode
 * @property string show_period
 */
class AppSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['audit_mode'], 'integer'],
            [['app_name', 'app_name_short', 'show_period'], 'string', 'max' => 150],
            [['app_mode'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'app_name' => 'App Name',
            'app_name_short' => 'App Name Short',
            'app_mode' => 'App Mode',
            'audit_mode' => 'Audit Mode',
            'show_period' => 'Show Period'
        ];
    }
}
