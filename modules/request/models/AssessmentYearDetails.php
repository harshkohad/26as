<?php

namespace app\modules\request\models;

use Yii;

/**
 * This is the model class for table "tbl_assessment_year_details".
 *
 * @property int $id
 * @property int $itr_request_id
 * @property string $assessment_year
 * @property string $image_url
 * @property string $remarks
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property int $is_deleted 0 > active, 1 > deleted
 */
class AssessmentYearDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_assessment_year_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['itr_request_id', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['image_url', 'remarks'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['assessment_year'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'itr_request_id' => 'Itr Request ID',
            'assessment_year' => 'Assessment Year',
            'image_url' => 'Image Url',
            'remarks' => 'Remarks',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
