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
class ApplicationsResiOffice extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_applications_resi_office';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['application_id'], 'required'],
            [['application_id', 'resi_office_home_area', 'resi_office_ownership_status', 'resi_office_stay_years', 'resi_office_total_family_members', 'resi_office_working_members', 'resi_office_employment_years', 'resi_office_locality', 'resi_office_locality_type', 'resi_office_market_feedback', 'resi_office_status', 'resi_office_is_reachable', 'resi_office_available_status', 'resi_office_shifted_tenure', 'created_by', 'update_by', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['resi_office_not_reachable_remarks'], 'string'],
            [['resi_office_reason_for_closed', 'resi_office_rented_owner_name'], 'string', 'max' => 100],
            [['resi_office_society_name_plate', 'resi_office_door_name_plate', 'resi_office_tpc_neighbor_1', 'resi_office_tpc_neighbor_2', 'resi_office_met_person', 'resi_office_met_person_designation', 'resi_office_relation', 'resi_office_ownership_status_text', 'resi_office_company_name_board', 'resi_office_designation', 'resi_office_department', 'resi_office_nature_of_company', 'resi_office_net_salary_amount', 'resi_office_tpc_for_applicant', 'resi_office_tpc_for_company', 'resi_office_locality_text', 'resi_office_landmark_1', 'resi_office_landmark_2'], 'string', 'max' => 150],
            [['resi_office_structure', 'resi_office_remarks', 'resi_office_address', 'resi_office_address_trigger'], 'string', 'max' => 1000],
            [['resi_office_rent_amount'], 'string', 'max' => 500],
            [['resi_office_address_pincode'], 'string', 'max' => 10],
            //[['resi_office_address_lat', 'resi_office_address_long'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'application_id' => 'Application ID',
            'resi_office_reason_for_closed' => 'Reason For Closed',
            'resi_office_society_name_plate' => 'Society Name Plate',
            'resi_office_door_name_plate' => 'Door Name Plate',
            'resi_office_tpc_neighbor_1' => 'Tpc Neighbor 1',
            'resi_office_tpc_neighbor_2' => 'Tpc Neighbor 2',
            'resi_office_met_person' => 'Met Person',
            'resi_office_met_person_designation' => 'Met Person Designation',
            'resi_office_relation' => 'Relation',
            'resi_office_home_area' => 'Home Area',
            'resi_office_ownership_status' => 'Ownership Status',
            'resi_office_ownership_status_text' => 'Ownership Status Text',
            'resi_office_stay_years' => 'Stay Years',
            'resi_office_total_family_members' => 'Total Family Members',
            'resi_office_working_members' => 'Working Members',
            'resi_office_company_name_board' => 'Company Name Board',
            'resi_office_designation' => 'Designation',
            'resi_office_department' => 'Department',
            'resi_office_nature_of_company' => 'Nature Of Company',
            'resi_office_employment_years' => 'Employment Years',
            'resi_office_net_salary_amount' => 'Net Salary Amount',
            'resi_office_tpc_for_applicant' => 'Tpc For Applicant',
            'resi_office_tpc_for_company' => 'Tpc For Company',
            'resi_office_locality' => 'Locality',
            'resi_office_locality_text' => 'Locality Other',
            'resi_office_locality_type' => 'Locality Type',
            'resi_office_landmark_1' => 'Landmark 1',
            'resi_office_landmark_2' => 'Landmark 2',
            'resi_office_structure' => 'Structure',
            'resi_office_market_feedback' => 'Market Feedback',
            'resi_office_remarks' => 'Remarks',
            'resi_office_status' => 'Status',
            'resi_office_is_reachable' => 'Is Reachable',
            'resi_office_not_reachable_remarks' => 'Not Reachable Remarks',
            'resi_office_rented_owner_name' => 'Rented Owner Name',
            'resi_office_rent_amount' => 'Rent Amount',
            'resi_office_available_status' => 'Available Status',
            'resi_office_shifted_tenure' => 'Shifted Tenure',
            'resi_office_address' => 'Address',
            'resi_office_address_verification' => 'Address Verification',
            'resi_office_address_pincode' => 'Address Pincode',
            'resi_office_address_trigger' => 'Address Trigger',
            'resi_office_address_lat' => 'Address Lat',
            'resi_office_address_long' => 'Address Long',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'update_by' => 'Update By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if (isset($this->id)) {
                $this->updated_on = date("Y-m-d H:i:s");
                $this->update_by = Yii::$app->user->id;
            } else {
                $this->created_on = date("Y-m-d H:i:s");
                $this->created_by = Yii::$app->user->id;
            }

            return true;
        }

        return FALSE;
    }

}
