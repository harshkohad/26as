<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_pincode_master".
 *
 * @property integer $id
 * @property string $pincode
 * @property string $po_name
 * @property string $city_name
 * @property string $state_name
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class PincodeMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pincode_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pincode', 'po_name', 'city_name', 'state_name'], 'required'],
            [['id', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['pincode'], 'string', 'max' => 10],
            [['po_name', 'city_name', 'state_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pincode' => 'Pincode',
            'po_name' => 'Po Name',
            'city_name' => 'City Name',
            'state_name' => 'State Name',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
