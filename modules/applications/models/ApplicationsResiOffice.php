<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_applications_resi_office".
 *
 * @property integer $id
 * @property integer $application_id
 * @property string $resi_office_reason_for_closed
 * @property string $resi_office_society_name_plate
 * @property string $resi_office_door_name_plate
 * @property string $resi_office_tpc_neighbor_1
 * @property string $resi_office_tpc_neighbor_2
 * @property string $resi_office_met_person
 * @property string $resi_office_met_person_designation
 * @property string $resi_office_relation
 * @property integer $resi_office_home_area
 * @property integer $resi_office_ownership_status
 * @property string $resi_office_ownership_status_text
 * @property integer $resi_office_stay_years
 * @property integer $resi_office_total_family_members
 * @property integer $resi_office_working_members
 * @property string $resi_office_company_name_board
 * @property string $resi_office_designation
 * @property string $resi_office_department
 * @property string $resi_office_nature_of_company
 * @property integer $resi_office_employment_years
 * @property string $resi_office_net_salary_amount
 * @property string $resi_office_tpc_for_applicant
 * @property string $resi_office_tpc_for_company
 * @property integer $resi_office_locality
 * @property string $resi_office_locality_text
 * @property integer $resi_office_locality_type
 * @property string $resi_office_landmark_1
 * @property string $resi_office_landmark_2
 * @property string $resi_office_structure
 * @property integer $resi_office_market_feedback
 * @property string $resi_office_remarks
 * @property integer $resi_office_status
 * @property integer $resi_office_is_reachable
 * @property string $resi_office_not_reachable_remarks
 * @property string $resi_office_rented_owner_name
 * @property string $resi_office_rent_amount
 * @property integer $resi_office_available_status
 * @property integer $resi_office_shifted_tenure
 * @property string $resi_office_address
 * @property integer $resi_office_address_verification
 * @property string $resi_office_address_pincode
 * @property string $resi_office_address_trigger
 * @property string $resi_office_address_lat
 * @property string $resi_office_address_long
 * @property integer $created_by
 * @property string $created_on
 * @property integer $update_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class ApplicationsResiOffice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_applications_resi_office';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['application_id'], 'required'],
            [['application_id', 'resi_office_home_area', 'resi_office_ownership_status', 'resi_office_stay_years', 'resi_office_total_family_members', 'resi_office_working_members', 'resi_office_employment_years', 'resi_office_locality', 'resi_office_locality_type', 'resi_office_market_feedback', 'resi_office_status', 'resi_office_is_reachable', 'resi_office_available_status', 'resi_office_shifted_tenure', 'resi_office_address_verification', 'created_by', 'update_by', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['resi_office_not_reachable_remarks'], 'string'],
            [['resi_office_reason_for_closed', 'resi_office_rented_owner_name'], 'string', 'max' => 100],
            [['resi_office_society_name_plate', 'resi_office_door_name_plate', 'resi_office_tpc_neighbor_1', 'resi_office_tpc_neighbor_2', 'resi_office_met_person', 'resi_office_met_person_designation', 'resi_office_relation', 'resi_office_ownership_status_text', 'resi_office_company_name_board', 'resi_office_designation', 'resi_office_department', 'resi_office_nature_of_company', 'resi_office_net_salary_amount', 'resi_office_tpc_for_applicant', 'resi_office_tpc_for_company', 'resi_office_locality_text', 'resi_office_landmark_1', 'resi_office_landmark_2'], 'string', 'max' => 150],
            [['resi_office_structure', 'resi_office_remarks', 'resi_office_address', 'resi_office_address_trigger'], 'string', 'max' => 1000],
            [['resi_office_rent_amount'], 'string', 'max' => 500],
            [['resi_office_address_pincode'], 'string', 'max' => 10],
            [['resi_office_address_lat', 'resi_office_address_long'], 'string', 'max' => 45],
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
            'resi_office_reason_for_closed' => 'Resi Office Reason For Closed',
            'resi_office_society_name_plate' => 'Resi Office Society Name Plate',
            'resi_office_door_name_plate' => 'Resi Office Door Name Plate',
            'resi_office_tpc_neighbor_1' => 'Resi Office Tpc Neighbor 1',
            'resi_office_tpc_neighbor_2' => 'Resi Office Tpc Neighbor 2',
            'resi_office_met_person' => 'Resi Office Met Person',
            'resi_office_met_person_designation' => 'Resi Office Met Person Designation',
            'resi_office_relation' => 'Resi Office Relation',
            'resi_office_home_area' => 'Resi Office Home Area',
            'resi_office_ownership_status' => 'Resi Office Ownership Status',
            'resi_office_ownership_status_text' => 'Resi Office Ownership Status Text',
            'resi_office_stay_years' => 'Resi Office Stay Years',
            'resi_office_total_family_members' => 'Resi Office Total Family Members',
            'resi_office_working_members' => 'Resi Office Working Members',
            'resi_office_company_name_board' => 'Resi Office Company Name Board',
            'resi_office_designation' => 'Resi Office Designation',
            'resi_office_department' => 'Resi Office Department',
            'resi_office_nature_of_company' => 'Resi Office Nature Of Company',
            'resi_office_employment_years' => 'Resi Office Employment Years',
            'resi_office_net_salary_amount' => 'Resi Office Net Salary Amount',
            'resi_office_tpc_for_applicant' => 'Resi Office Tpc For Applicant',
            'resi_office_tpc_for_company' => 'Resi Office Tpc For Company',
            'resi_office_locality' => 'Resi Office Locality',
            'resi_office_locality_text' => 'Resi Office Locality Text',
            'resi_office_locality_type' => 'Resi Office Locality Type',
            'resi_office_landmark_1' => 'Resi Office Landmark 1',
            'resi_office_landmark_2' => 'Resi Office Landmark 2',
            'resi_office_structure' => 'Resi Office Structure',
            'resi_office_market_feedback' => 'Resi Office Market Feedback',
            'resi_office_remarks' => 'Resi Office Remarks',
            'resi_office_status' => 'Resi Office Status',
            'resi_office_is_reachable' => 'Resi Office Is Reachable',
            'resi_office_not_reachable_remarks' => 'Resi Office Not Reachable Remarks',
            'resi_office_rented_owner_name' => 'Resi Office Rented Owner Name',
            'resi_office_rent_amount' => 'Resi Office Rent Amount',
            'resi_office_available_status' => 'Resi Office Available Status',
            'resi_office_shifted_tenure' => 'Resi Office Shifted Tenure',
            'resi_office_address' => 'Resi Office Address',
            'resi_office_address_verification' => 'Resi Office Address Verification',
            'resi_office_address_pincode' => 'Resi Office Address Pincode',
            'resi_office_address_trigger' => 'Resi Office Address Trigger',
            'resi_office_address_lat' => 'Resi Office Address Lat',
            'resi_office_address_long' => 'Resi Office Address Long',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'update_by' => 'Update By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
