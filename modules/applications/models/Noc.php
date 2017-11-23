<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_noc".
 *
 * @property integer $id
 * @property integer $application_id
 * @property string $met_person
 * @property string $designation
 * @property string $remarks
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class Noc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_noc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['application_id', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['met_person', 'designation'], 'string', 'max' => 150],
            [['remarks'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'application_id' => 'Application ID',
            'met_person' => 'Met Person',
            'designation' => 'Designation',
            'remarks' => 'Remarks',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
