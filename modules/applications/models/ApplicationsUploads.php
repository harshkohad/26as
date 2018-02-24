<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_applications_uploads".
 *
 * @property integer $id
 * @property integer $institute_id
 * @property integer $loan_type_id
 * @property string $file_name
 * @property integer $status
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class ApplicationsUploads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_applications_uploads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['institute_id', 'loan_type_id', 'file_name'], 'required'],
            [['id', 'institute_id', 'loan_type_id', 'status', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['file_name'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'institute_id' => 'Institute ID',
            'loan_type_id' => 'Loan Type ID',
            'file_name' => 'File Name',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
