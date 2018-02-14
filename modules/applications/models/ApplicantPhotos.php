<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_applicant_photos".
 *
 * @property integer $id
 * @property integer $application_id
 * @property integer $section
 * @property integer $type
 * @property string $remarks
 * @property string $file_name
 * @property string $latitude
 * @property string $longitude
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class ApplicantPhotos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_applicant_photos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['application_id', 'section', 'type', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['remarks', 'file_name'], 'string', 'max' => 1000],
            [['latitude', 'longitude'], 'string', 'max' => 45],
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
            'section' => 'Section',
            'type' => 'Type',
            'remarks' => 'Remarks',
            'file_name' => 'File Name',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
