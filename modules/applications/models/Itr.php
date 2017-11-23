<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_itr".
 *
 * @property integer $id
 * @property integer $application_id
 * @property string $total_income
 * @property string $date_of_filing
 * @property string $pan_card_no
 * @property string $acknowledgement_no
 * @property string $assessment_year
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class Itr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_itr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['application_id', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['date_of_filing', 'assessment_year', 'created_on', 'updated_on'], 'safe'],
            [['total_income'], 'string', 'max' => 10],
            [['pan_card_no', 'acknowledgement_no'], 'string', 'max' => 150],
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
            'total_income' => 'Total Income',
            'date_of_filing' => 'Date Of Filing',
            'pan_card_no' => 'Pan Card No',
            'acknowledgement_no' => 'Acknowledgement No',
            'assessment_year' => 'Assessment Year',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
