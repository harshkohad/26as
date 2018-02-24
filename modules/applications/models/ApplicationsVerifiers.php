<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_applications_verifiers".
 *
 * @property integer $id
 * @property integer $application_id
 * @property integer $verification_type
 * @property integer $mobile_user_id
 * @property string $mobile_user_assigned_date
 * @property integer $mobile_user_status
 * @property string $mobile_user_status_updated_on
 * @property integer $created_by
 * @property string $created_on
 * @property integer $update_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class ApplicationsVerifiers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_applications_verifiers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['application_id', 'verification_type', 'mobile_user_id', 'mobile_user_status', 'created_by', 'update_by', 'is_deleted'], 'integer'],
            [['mobile_user_assigned_date', 'mobile_user_status_updated_on', 'created_on', 'updated_on'], 'safe'],
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
            'verification_type' => 'Verification Type',
            'mobile_user_id' => 'Mobile User ID',
            'mobile_user_assigned_date' => 'Mobile User Assigned Date',
            'mobile_user_status' => 'Mobile User Status',
            'mobile_user_status_updated_on' => 'Mobile User Status Updated On',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'update_by' => 'Update By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
