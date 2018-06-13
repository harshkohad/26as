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
 * @property integer $update_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class ApplicationsBuilderProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_applications_builder_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['application_id'], 'required'],
            [['application_id', 'builder_profile_exsistence', 'builder_profile_staff', 'builder_profile_area', 'builder_profile_type_of_office', 'builder_profile_is_reachable', 'builder_profile_address_verification', 'created_by', 'update_by', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['builder_profile_not_reachable_remarks'], 'string'],
            [['builder_profile_company_name_board', 'builder_profile_met_person', 'builder_profile_met_person_designation', 'builder_profile_tpc_neighbor_1', 'builder_profile_tpc_neighbor_2', 'builder_profile_landmark_1', 'builder_profile_landmark_2'], 'string', 'max' => 150],
            [['builder_profile_current_projects', 'builder_profile_previous_projects', 'builder_profile_address', 'builder_profile_address_trigger'], 'string', 'max' => 1000],
            [['builder_profile_address_pincode'], 'string', 'max' => 10],
            [['builder_profile_address_lat', 'builder_profile_address_long'], 'string', 'max' => 45],
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
            'builder_profile_company_name_board' => 'Builder Profile Company Name Board',
            'builder_profile_met_person' => 'Builder Profile Met Person',
            'builder_profile_met_person_designation' => 'Builder Profile Met Person Designation',
            'builder_profile_exsistence' => 'Builder Profile Exsistence',
            'builder_profile_current_projects' => 'Builder Profile Current Projects',
            'builder_profile_previous_projects' => 'Builder Profile Previous Projects',
            'builder_profile_staff' => 'Builder Profile Staff',
            'builder_profile_area' => 'Builder Profile Area',
            'builder_profile_type_of_office' => 'Builder Profile Type Of Office',
            'builder_profile_tpc_neighbor_1' => 'Builder Profile Tpc Neighbor 1',
            'builder_profile_tpc_neighbor_2' => 'Builder Profile Tpc Neighbor 2',
            'builder_profile_landmark_1' => 'Builder Profile Landmark 1',
            'builder_profile_landmark_2' => 'Builder Profile Landmark 2',
            'builder_profile_is_reachable' => 'Builder Profile Is Reachable',
            'builder_profile_not_reachable_remarks' => 'Builder Profile Not Reachable Remarks',
            'builder_profile_address' => 'Builder Profile Address',
            'builder_profile_address_verification' => 'Builder Profile Address Verification',
            'builder_profile_address_pincode' => 'Builder Profile Address Pincode',
            'builder_profile_address_trigger' => 'Builder Profile Address Trigger',
            'builder_profile_address_lat' => 'Builder Profile Address Lat',
            'builder_profile_address_long' => 'Builder Profile Address Long',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'update_by' => 'Update By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
