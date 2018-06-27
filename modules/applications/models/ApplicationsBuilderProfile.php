<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_applications_builder_profile".
 *
 * @property integer $id
 * @property integer $application_id
 * @property string $builder_profile_company_name_board
 * @property string $builder_profile_met_person
 * @property string $builder_profile_met_person_designation
 * @property integer $builder_profile_exsistence
 * @property string $builder_profile_current_projects
 * @property string $builder_profile_previous_projects
 * @property integer $builder_profile_staff
 * @property integer $builder_profile_area
 * @property integer $builder_profile_type_of_office
 * @property string $builder_profile_tpc_neighbor_1
 * @property string $builder_profile_tpc_neighbor_2
 * @property string $builder_profile_landmark_1
 * @property string $builder_profile_landmark_2
 * @property integer $builder_profile_is_reachable
 * @property string $builder_profile_not_reachable_remarks
 * @property string $builder_profile_address
 * @property integer $builder_profile_address_verification
 * @property string $builder_profile_address_pincode
 * @property string $builder_profile_address_trigger
 * @property string $builder_profile_address_lat
 * @property string $builder_profile_address_long
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class ApplicationsBuilderProfile extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_applications_builder_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['application_id'], 'required'],
            [['application_id', 'builder_profile_exsistence', 'builder_profile_staff', 'builder_profile_area', 'builder_profile_type_of_office', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on', 'builder_profile_address_pincode', 'builder_profile_address_lat', 'builder_profile_address_long', 'builder_profile_is_reachable'], 'safe'],
            [['builder_profile_not_reachable_remarks'], 'string'],
            [['builder_profile_company_name_board', 'builder_profile_met_person', 'builder_profile_met_person_designation', 'builder_profile_tpc_neighbor_1', 'builder_profile_tpc_neighbor_2', 'builder_profile_landmark_1', 'builder_profile_landmark_2'], 'string', 'max' => 150],
            [['builder_profile_current_projects', 'builder_profile_previous_projects', 'builder_profile_address', 'builder_profile_address_trigger'], 'string', 'max' => 1000],
//            [['builder_profile_address_pincode'], 'string', 'max' => 10],
            //[['builder_profile_address_lat', 'builder_profile_address_long'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'application_id' => 'Application ID',
            'builder_profile_company_name_board' => 'Company Name Board',
            'builder_profile_met_person' => 'Met Person',
            'builder_profile_met_person_designation' => 'Met Person Designation',
            'builder_profile_exsistence' => 'Exsistence',
            'builder_profile_current_projects' => 'Current Projects',
            'builder_profile_previous_projects' => 'Previous Projects',
            'builder_profile_staff' => 'Staff',
            'builder_profile_area' => 'Area',
            'builder_profile_type_of_office' => 'Type Of Office',
            'builder_profile_tpc_neighbor_1' => 'Tpc Neighbor 1',
            'builder_profile_tpc_neighbor_2' => 'Tpc Neighbor 2',
            'builder_profile_landmark_1' => 'Landmark 1',
            'builder_profile_landmark_2' => 'Landmark 2',
            'builder_profile_is_reachable' => 'Is Reachable',
            'builder_profile_not_reachable_remarks' => 'Not Reachable Remarks',
            'builder_profile_address' => 'Address',
            'builder_profile_address_verification' => 'Address Verification',
            'builder_profile_address_pincode' => 'Address Pincode',
            'builder_profile_address_trigger' => 'Address Trigger',
            'builder_profile_address_lat' => 'Address Lat',
            'builder_profile_address_long' => 'Address Long',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if (isset($this->id)) {
                $this->updated_on = date("Y-m-d H:i:s");
                $this->updated_by = Yii::$app->user->id;
            } else {
                $this->created_on = date("Y-m-d H:i:s");
                $this->created_by = Yii::$app->user->id;
            }

            return true;
        }

        return FALSE;
    }

}
