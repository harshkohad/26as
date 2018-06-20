<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_applications_history".
 *
 * @property integer $id
 * @property string $previous_id
 * @property string $application_id
 * @property integer $profile_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $date_of_birth
 * @property string $aadhaar_card_no
 * @property string $pan_card_no
 * @property string $mobile_no
 * @property string $alternate_contact_no
 * @property string $case_id
 * @property string $branch
 * @property integer $institute_id
 * @property integer $loan_type_id
 * @property integer $applicant_type
 * @property integer $profile_type
 * @property integer $area_id
 * @property string $date_of_application
 * @property string $resi_society_name_plate
 * @property string $resi_door_name_plate
 * @property string $resi_tpc_neighbor_1
 * @property string $resi_tpc_neighbor_2
 * @property string $resi_met_person
 * @property string $resi_relation
 * @property integer $resi_home_area
 * @property integer $resi_ownership_status
 * @property string $resi_ownership_status_text
 * @property integer $resi_stay_years
 * @property integer $resi_total_family_members
 * @property integer $resi_working_members
 * @property integer $resi_locality
 * @property string $resi_locality_text
 * @property string $resi_landmark_1
 * @property string $resi_landmark_2
 * @property string $resi_structure
 * @property integer $resi_market_feedback
 * @property string $resi_remarks
 * @property integer $resi_status
 * @property integer $resi_is_reachable
 * @property string $resi_not_reachable_remarks
 * @property string $busi_tpc_neighbor_1
 * @property string $busi_tpc_neighbor_2
 * @property string $busi_company_name_board
 * @property string $busi_met_person
 * @property string $busi_designation
 * @property string $busi_designation_others
 * @property string $busi_nature_of_business
 * @property integer $busi_staff_declared
 * @property integer $busi_staff_seen
 * @property integer $busi_years_in_business
 * @property integer $busi_type_of_business
 * @property integer $busi_ownership_status
 * @property string $busi_ownership_status_text
 * @property integer $busi_area
 * @property integer $busi_locality
 * @property string $busi_locality_text
 * @property string $busi_landmark_1
 * @property string $busi_landmark_2
 * @property integer $busi_activity_seen
 * @property string $busi_structure
 * @property string $busi_remarks
 * @property integer $busi_status
 * @property integer $busi_is_reachable
 * @property string $busi_not_reachable_remarks
 * @property string $office_company_name_board
 * @property string $office_designation
 * @property string $office_met_person
 * @property string $office_met_person_designation
 * @property string $office_department
 * @property string $office_nature_of_company
 * @property integer $office_employment_years
 * @property string $office_net_salary_amount
 * @property string $office_tpc_for_applicant
 * @property string $office_tpc_for_company
 * @property string $office_landmark
 * @property string $office_structure
 * @property string $office_remarks
 * @property integer $office_status
 * @property integer $office_is_reachable
 * @property string $office_not_reachable_remarks
 * @property string $financial_pan_card_no
 * @property string $financial_name
 * @property string $financial_assessment_year
 * @property string $financial_date_of_filing
 * @property string $financial_sales
 * @property string $financial_share_capital
 * @property string $financial_net_profit
 * @property string $financial_debtors
 * @property string $financial_creditors
 * @property string $financial_total_loans
 * @property string $financial_depriciation
 * @property string $bank_bank_name
 * @property string $bank_account_holder
 * @property string $bank_account_number
 * @property string $bank_dated_transaction
 * @property string $bank_pan_card_no
 * @property string $bank_current_balance
 * @property string $bank_account_opening_date
 * @property string $bank_date_of_birth
 * @property string $bank_address
 * @property string $bank_narration
 * @property string $noc_structure
 * @property string $noc_status
 * @property integer $noc_is_reachable
 * @property string $noc_not_reachable_remarks
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
 * @property string $resi_office_landmark_1
 * @property string $resi_office_landmark_2
 * @property string $resi_office_structure
 * @property integer $resi_office_market_feedback
 * @property string $resi_office_remarks
 * @property integer $resi_office_status
 * @property integer $resi_office_is_reachable
 * @property string $resi_office_not_reachable_remarks
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
 * @property string $property_apf_met_person
 * @property string $property_apf_met_person_designation
 * @property integer $property_apf_property_status
 * @property integer $property_apf_no_of_workers
 * @property string $property_apf_mode_of_payment
 * @property string $property_apf_construction_stock
 * @property integer $property_apf_total_flats
 * @property integer $property_apf_how_many_sold
 * @property integer $property_apf_total_shops
 * @property integer $property_apf_area
 * @property string $property_apf_work_completed
 * @property string $property_apf_possession
 * @property string $property_apf_apf
 * @property string $property_apf_delay_in_work
 * @property string $property_apf_tpc
 * @property string $property_apf_landmark
 * @property integer $property_apf_is_reachable
 * @property string $property_apf_not_reachable_remarks
 * @property string $indiv_property_met_person
 * @property string $indiv_property_met_person_designation
 * @property string $indiv_property_property_confirmed
 * @property string $indiv_property_previous_owner
 * @property integer $indiv_property_property_type
 * @property integer $indiv_property_area
 * @property string $indiv_property_approx_market_value
 * @property string $indiv_property_society_name_plate
 * @property string $indiv_property_door_name_plate
 * @property string $indiv_property_tpc
 * @property string $indiv_property_landmark
 * @property integer $indiv_property_is_reachable
 * @property string $indiv_property_not_reachable_remarks
 * @property string $noc_soc_met_person
 * @property string $noc_soc_met_person_designation
 * @property string $noc_soc_signature_done_by
 * @property string $noc_soc_bldg_reg_number
 * @property integer $noc_soc_society_type
 * @property string $noc_soc_previous_owner
 * @property integer $noc_soc_is_reachable
 * @property string $noc_soc_not_reachable_remarks
 * @property integer $application_status
 * @property string $resi_address
 * @property integer $resi_address_verification
 * @property string $resi_address_pincode
 * @property string $resi_address_trigger
 * @property string $resi_address_lat
 * @property string $resi_address_long
 * @property string $office_address
 * @property integer $office_address_verification
 * @property string $office_address_pincode
 * @property string $office_address_trigger
 * @property string $office_address_lat
 * @property string $office_address_long
 * @property string $busi_address
 * @property integer $busi_address_verification
 * @property string $busi_address_pincode
 * @property string $busi_address_trigger
 * @property string $busi_address_lat
 * @property string $busi_address_long
 * @property string $noc_address
 * @property integer $noc_address_verification
 * @property string $noc_address_pincode
 * @property string $noc_address_trigger
 * @property string $noc_address_lat
 * @property string $noc_address_long
 * @property string $resi_office_address
 * @property integer $resi_office_address_verification
 * @property string $resi_office_address_pincode
 * @property string $resi_office_address_trigger
 * @property string $resi_office_address_lat
 * @property string $resi_office_address_long
 * @property string $builder_profile_address
 * @property integer $builder_profile_address_verification
 * @property string $builder_profile_address_pincode
 * @property string $builder_profile_address_trigger
 * @property string $builder_profile_address_lat
 * @property string $builder_profile_address_long
 * @property string $property_apf_address
 * @property integer $property_apf_address_verification
 * @property string $property_apf_address_pincode
 * @property string $property_apf_address_trigger
 * @property string $property_apf_address_lat
 * @property string $property_apf_address_long
 * @property string $indiv_property_address
 * @property integer $indiv_property_address_verification
 * @property string $indiv_property_address_pincode
 * @property string $indiv_property_address_trigger
 * @property string $indiv_property_address_lat
 * @property string $indiv_property_address_long
 * @property string $noc_soc_address
 * @property integer $noc_soc_address_verification
 * @property string $noc_soc_address_pincode
 * @property string $noc_soc_address_trigger
 * @property string $noc_soc_address_lat
 * @property string $noc_soc_address_long
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $is_deleted
 * @property string $company_name
 * @property string $address
 */
class ApplicationsHistory extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_applications_history';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['previous_id', 'date_of_birth', 'date_of_application', 'financial_assessment_year', 'financial_date_of_filing', 'bank_dated_transaction', 'bank_account_opening_date', 'bank_date_of_birth', 'created_on', 'updated_on'], 'safe'],
            [['profile_id'], 'required'],
            [['profile_id', 'institute_id', 'loan_type_id', 'applicant_type', 'profile_type', 'area_id', 'resi_home_area', 'resi_ownership_status', 'resi_stay_years', 'resi_total_family_members', 'resi_working_members', 'resi_locality', 'resi_market_feedback', 'resi_status', 'resi_is_reachable', 'busi_staff_declared', 'busi_staff_seen', 'busi_years_in_business', 'busi_type_of_business', 'busi_ownership_status', 'busi_area', 'busi_locality', 'busi_activity_seen', 'busi_status', 'busi_is_reachable', 'office_employment_years', 'office_status', 'office_is_reachable', 'noc_is_reachable', 'resi_office_home_area', 'resi_office_ownership_status', 'resi_office_stay_years', 'resi_office_total_family_members', 'resi_office_working_members', 'resi_office_employment_years', 'resi_office_locality', 'resi_office_market_feedback', 'resi_office_status', 'resi_office_is_reachable', 'builder_profile_exsistence', 'builder_profile_staff', 'builder_profile_area', 'builder_profile_type_of_office', 'builder_profile_is_reachable', 'property_apf_property_status', 'property_apf_no_of_workers', 'property_apf_total_flats', 'property_apf_how_many_sold', 'property_apf_total_shops', 'property_apf_area', 'property_apf_is_reachable', 'indiv_property_property_type', 'indiv_property_area', 'indiv_property_is_reachable', 'noc_soc_society_type', 'noc_soc_is_reachable', 'application_status', 'resi_address_verification', 'office_address_verification', 'busi_address_verification', 'noc_address_verification', 'resi_office_address_verification', 'builder_profile_address_verification', 'property_apf_address_verification', 'indiv_property_address_verification', 'noc_soc_address_verification', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['resi_not_reachable_remarks', 'busi_not_reachable_remarks', 'office_not_reachable_remarks', 'noc_not_reachable_remarks', 'resi_office_not_reachable_remarks', 'builder_profile_not_reachable_remarks', 'property_apf_not_reachable_remarks', 'indiv_property_not_reachable_remarks', 'noc_soc_not_reachable_remarks'], 'string'],
            [['application_id', 'first_name', 'middle_name', 'last_name', 'aadhaar_card_no', 'pan_card_no', 'mobile_no', 'resi_society_name_plate', 'resi_door_name_plate', 'resi_tpc_neighbor_1', 'resi_tpc_neighbor_2', 'resi_met_person', 'resi_relation', 'resi_ownership_status_text', 'resi_locality_text', 'resi_landmark_1', 'resi_landmark_2', 'busi_tpc_neighbor_1', 'busi_tpc_neighbor_2', 'busi_company_name_board', 'busi_met_person', 'busi_designation', 'busi_nature_of_business', 'busi_ownership_status_text', 'busi_locality_text', 'busi_landmark_1', 'busi_landmark_2', 'office_company_name_board', 'office_designation', 'office_met_person', 'office_met_person_designation', 'office_department', 'office_nature_of_company', 'office_net_salary_amount', 'office_tpc_for_applicant', 'office_tpc_for_company', 'office_landmark', 'financial_pan_card_no', 'financial_name', 'financial_sales', 'financial_share_capital', 'financial_net_profit', 'financial_debtors', 'financial_creditors', 'financial_total_loans', 'financial_depriciation', 'bank_bank_name', 'bank_account_holder', 'bank_account_number', 'bank_pan_card_no', 'bank_current_balance', 'resi_office_society_name_plate', 'resi_office_door_name_plate', 'resi_office_tpc_neighbor_1', 'resi_office_tpc_neighbor_2', 'resi_office_met_person', 'resi_office_met_person_designation', 'resi_office_relation', 'resi_office_ownership_status_text', 'resi_office_company_name_board', 'resi_office_designation', 'resi_office_department', 'resi_office_nature_of_company', 'resi_office_net_salary_amount', 'resi_office_tpc_for_applicant', 'resi_office_tpc_for_company', 'resi_office_locality_text', 'resi_office_landmark_1', 'resi_office_landmark_2', 'builder_profile_company_name_board', 'builder_profile_met_person', 'builder_profile_met_person_designation', 'builder_profile_tpc_neighbor_1', 'builder_profile_tpc_neighbor_2', 'builder_profile_landmark_1', 'builder_profile_landmark_2', 'property_apf_met_person', 'property_apf_met_person_designation', 'property_apf_mode_of_payment', 'property_apf_construction_stock', 'property_apf_work_completed', 'property_apf_possession', 'property_apf_apf', 'property_apf_delay_in_work', 'property_apf_tpc', 'property_apf_landmark', 'indiv_property_met_person', 'indiv_property_met_person_designation', 'indiv_property_property_confirmed', 'indiv_property_previous_owner', 'indiv_property_approx_market_value', 'indiv_property_society_name_plate', 'indiv_property_door_name_plate', 'indiv_property_tpc', 'indiv_property_landmark', 'noc_soc_met_person', 'noc_soc_met_person_designation', 'noc_soc_signature_done_by', 'noc_soc_bldg_reg_number', 'noc_soc_previous_owner'], 'string', 'max' => 150],
            [['alternate_contact_no'], 'string', 'max' => 50],
            [['case_id', 'branch', 'busi_designation_others', 'company_name'], 'string', 'max' => 100],
            [['resi_structure', 'resi_remarks', 'busi_structure', 'busi_remarks', 'office_structure', 'office_remarks', 'bank_address', 'bank_narration', 'noc_structure', 'resi_office_structure', 'resi_office_remarks', 'builder_profile_current_projects', 'builder_profile_previous_projects', 'resi_address', 'resi_address_trigger', 'office_address', 'office_address_trigger', 'busi_address', 'busi_address_trigger', 'noc_address', 'noc_address_trigger', 'resi_office_address', 'resi_office_address_trigger', 'builder_profile_address', 'builder_profile_address_trigger', 'property_apf_address', 'property_apf_address_trigger', 'indiv_property_address', 'indiv_property_address_trigger', 'noc_soc_address', 'noc_soc_address_trigger'], 'string', 'max' => 1000],
            [['noc_status', 'resi_address_lat', 'resi_address_long', 'office_address_lat', 'office_address_long', 'busi_address_lat', 'busi_address_long', 'noc_address_lat', 'noc_address_long', 'resi_office_address_lat', 'resi_office_address_long', 'builder_profile_address_lat', 'builder_profile_address_long', 'property_apf_address_lat', 'property_apf_address_long', 'indiv_property_address_lat', 'indiv_property_address_long', 'noc_soc_address_lat', 'noc_soc_address_long'], 'string', 'max' => 45],
            [['resi_address_pincode', 'office_address_pincode', 'busi_address_pincode', 'noc_address_pincode', 'resi_office_address_pincode', 'builder_profile_address_pincode', 'property_apf_address_pincode', 'indiv_property_address_pincode', 'noc_soc_address_pincode'], 'string', 'max' => 10],
            [['address'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'previous_id' => 'Previous ID',
            'application_id' => 'Application ID',
            'profile_id' => 'Profile ID',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'date_of_birth' => 'Date Of Birth',
            'aadhaar_card_no' => 'Aadhaar Card No',
            'pan_card_no' => 'Pan Card No',
            'mobile_no' => 'Mobile No',
            'alternate_contact_no' => 'Alternate Contact No',
            'case_id' => 'Case ID',
            'branch' => 'Branch',
            'institute_id' => 'Institute ID',
            'loan_type_id' => 'Loan Type ID',
            'applicant_type' => 'Applicant Type',
            'profile_type' => 'Profile Type',
            'area_id' => 'Area ID',
            'date_of_application' => 'Date Of Application',
            'resi_society_name_plate' => 'Resi Society Name Plate',
            'resi_door_name_plate' => 'Resi Door Name Plate',
            'resi_tpc_neighbor_1' => 'Resi Tpc Neighbor 1',
            'resi_tpc_neighbor_2' => 'Resi Tpc Neighbor 2',
            'resi_met_person' => 'Resi Met Person',
            'resi_relation' => 'Resi Relation',
            'resi_home_area' => 'Resi Home Area',
            'resi_ownership_status' => 'Resi Ownership Status',
            'resi_ownership_status_text' => 'Resi Ownership Status Text',
            'resi_stay_years' => 'Resi Stay Years',
            'resi_total_family_members' => 'Resi Total Family Members',
            'resi_working_members' => 'Resi Working Members',
            'resi_locality' => 'Resi Locality',
            'resi_locality_text' => 'Resi Locality Text',
            'resi_landmark_1' => 'Resi Landmark 1',
            'resi_landmark_2' => 'Resi Landmark 2',
            'resi_structure' => 'Resi Structure',
            'resi_market_feedback' => 'Resi Market Feedback',
            'resi_remarks' => 'Resi Remarks',
            'resi_status' => 'Resi Status',
            'resi_is_reachable' => 'Resi Is Reachable',
            'resi_not_reachable_remarks' => 'Resi Not Reachable Remarks',
            'busi_tpc_neighbor_1' => 'Busi Tpc Neighbor 1',
            'busi_tpc_neighbor_2' => 'Busi Tpc Neighbor 2',
            'busi_company_name_board' => 'Busi Company Name Board',
            'busi_met_person' => 'Busi Met Person',
            'busi_designation' => 'Busi Designation',
            'busi_designation_others' => 'Busi Designation Others',
            'busi_nature_of_business' => 'Busi Nature Of Business',
            'busi_staff_declared' => 'Busi Staff Declared',
            'busi_staff_seen' => 'Busi Staff Seen',
            'busi_years_in_business' => 'Busi Years In Business',
            'busi_type_of_business' => 'Busi Type Of Business',
            'busi_ownership_status' => 'Busi Ownership Status',
            'busi_ownership_status_text' => 'Busi Ownership Status Text',
            'busi_area' => 'Busi Area',
            'busi_locality' => 'Busi Locality',
            'busi_locality_text' => 'Busi Locality Text',
            'busi_landmark_1' => 'Busi Landmark 1',
            'busi_landmark_2' => 'Busi Landmark 2',
            'busi_activity_seen' => 'Busi Activity Seen',
            'busi_structure' => 'Busi Structure',
            'busi_remarks' => 'Busi Remarks',
            'busi_status' => 'Busi Status',
            'busi_is_reachable' => 'Busi Is Reachable',
            'busi_not_reachable_remarks' => 'Busi Not Reachable Remarks',
            'office_company_name_board' => 'Office Company Name Board',
            'office_designation' => 'Office Designation',
            'office_met_person' => 'Office Met Person',
            'office_met_person_designation' => 'Office Met Person Designation',
            'office_department' => 'Office Department',
            'office_nature_of_company' => 'Office Nature Of Company',
            'office_employment_years' => 'Office Employment Years',
            'office_net_salary_amount' => 'Office Net Salary Amount',
            'office_tpc_for_applicant' => 'Office Tpc For Applicant',
            'office_tpc_for_company' => 'Office Tpc For Company',
            'office_landmark' => 'Office Landmark',
            'office_structure' => 'Office Structure',
            'office_remarks' => 'Office Remarks',
            'office_status' => 'Office Status',
            'office_is_reachable' => 'Office Is Reachable',
            'office_not_reachable_remarks' => 'Office Not Reachable Remarks',
            'financial_pan_card_no' => 'Financial Pan Card No',
            'financial_name' => 'Financial Name',
            'financial_assessment_year' => 'Financial Assessment Year',
            'financial_date_of_filing' => 'Financial Date Of Filing',
            'financial_sales' => 'Financial Sales',
            'financial_share_capital' => 'Financial Share Capital',
            'financial_net_profit' => 'Financial Net Profit',
            'financial_debtors' => 'Financial Debtors',
            'financial_creditors' => 'Financial Creditors',
            'financial_total_loans' => 'Financial Total Loans',
            'financial_depriciation' => 'Financial Depriciation',
            'bank_bank_name' => 'Bank Bank Name',
            'bank_account_holder' => 'Bank Account Holder',
            'bank_account_number' => 'Bank Account Number',
            'bank_dated_transaction' => 'Bank Dated Transaction',
            'bank_pan_card_no' => 'Bank Pan Card No',
            'bank_current_balance' => 'Bank Current Balance',
            'bank_account_opening_date' => 'Bank Account Opening Date',
            'bank_date_of_birth' => 'Bank Date Of Birth',
            'bank_address' => 'Bank Address',
            'bank_narration' => 'Bank Narration',
            'noc_structure' => 'Noc Structure',
            'noc_status' => 'Noc Status',
            'noc_is_reachable' => 'Noc Is Reachable',
            'noc_not_reachable_remarks' => 'Noc Not Reachable Remarks',
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
            'resi_office_landmark_1' => 'Resi Office Landmark 1',
            'resi_office_landmark_2' => 'Resi Office Landmark 2',
            'resi_office_structure' => 'Resi Office Structure',
            'resi_office_market_feedback' => 'Resi Office Market Feedback',
            'resi_office_remarks' => 'Resi Office Remarks',
            'resi_office_status' => 'Resi Office Status',
            'resi_office_is_reachable' => 'Resi Office Is Reachable',
            'resi_office_not_reachable_remarks' => 'Resi Office Not Reachable Remarks',
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
            'property_apf_met_person' => 'Property Apf Met Person',
            'property_apf_met_person_designation' => 'Property Apf Met Person Designation',
            'property_apf_property_status' => 'Property Apf Property Status',
            'property_apf_no_of_workers' => 'Property Apf No Of Workers',
            'property_apf_mode_of_payment' => 'Property Apf Mode Of Payment',
            'property_apf_construction_stock' => 'Property Apf Construction Stock',
            'property_apf_total_flats' => 'Property Apf Total Flats',
            'property_apf_how_many_sold' => 'Property Apf How Many Sold',
            'property_apf_total_shops' => 'Property Apf Total Shops',
            'property_apf_area' => 'Property Apf Area',
            'property_apf_work_completed' => 'Property Apf Work Completed',
            'property_apf_possession' => 'Property Apf Possession',
            'property_apf_apf' => 'Property Apf Apf',
            'property_apf_delay_in_work' => 'Property Apf Delay In Work',
            'property_apf_tpc' => 'Property Apf Tpc',
            'property_apf_landmark' => 'Property Apf Landmark',
            'property_apf_is_reachable' => 'Property Apf Is Reachable',
            'property_apf_not_reachable_remarks' => 'Property Apf Not Reachable Remarks',
            'indiv_property_met_person' => 'Indiv Property Met Person',
            'indiv_property_met_person_designation' => 'Indiv Property Met Person Designation',
            'indiv_property_property_confirmed' => 'Indiv Property Property Confirmed',
            'indiv_property_previous_owner' => 'Indiv Property Previous Owner',
            'indiv_property_property_type' => 'Indiv Property Property Type',
            'indiv_property_area' => 'Indiv Property Area',
            'indiv_property_approx_market_value' => 'Indiv Property Approx Market Value',
            'indiv_property_society_name_plate' => 'Indiv Property Society Name Plate',
            'indiv_property_door_name_plate' => 'Indiv Property Door Name Plate',
            'indiv_property_tpc' => 'Indiv Property Tpc',
            'indiv_property_landmark' => 'Indiv Property Landmark',
            'indiv_property_is_reachable' => 'Indiv Property Is Reachable',
            'indiv_property_not_reachable_remarks' => 'Indiv Property Not Reachable Remarks',
            'noc_soc_met_person' => 'Noc Soc Met Person',
            'noc_soc_met_person_designation' => 'Noc Soc Met Person Designation',
            'noc_soc_signature_done_by' => 'Noc Soc Signature Done By',
            'noc_soc_bldg_reg_number' => 'Noc Soc Bldg Reg Number',
            'noc_soc_society_type' => 'Noc Soc Society Type',
            'noc_soc_previous_owner' => 'Noc Soc Previous Owner',
            'noc_soc_is_reachable' => 'Noc Soc Is Reachable',
            'noc_soc_not_reachable_remarks' => 'Noc Soc Not Reachable Remarks',
            'application_status' => 'Application Status',
            'resi_address' => 'Resi Address',
            'resi_address_verification' => 'Resi Address Verification',
            'resi_address_pincode' => 'Resi Address Pincode',
            'resi_address_trigger' => 'Resi Address Trigger',
            'resi_address_lat' => 'Resi Address Lat',
            'resi_address_long' => 'Resi Address Long',
            'office_address' => 'Office Address',
            'office_address_verification' => 'Office Address Verification',
            'office_address_pincode' => 'Office Address Pincode',
            'office_address_trigger' => 'Office Address Trigger',
            'office_address_lat' => 'Office Address Lat',
            'office_address_long' => 'Office Address Long',
            'busi_address' => 'Busi Address',
            'busi_address_verification' => 'Busi Address Verification',
            'busi_address_pincode' => 'Busi Address Pincode',
            'busi_address_trigger' => 'Busi Address Trigger',
            'busi_address_lat' => 'Busi Address Lat',
            'busi_address_long' => 'Busi Address Long',
            'noc_address' => 'Noc Address',
            'noc_address_verification' => 'Noc Address Verification',
            'noc_address_pincode' => 'Noc Address Pincode',
            'noc_address_trigger' => 'Noc Address Trigger',
            'noc_address_lat' => 'Noc Address Lat',
            'noc_address_long' => 'Noc Address Long',
            'resi_office_address' => 'Resi Office Address',
            'resi_office_address_verification' => 'Resi Office Address Verification',
            'resi_office_address_pincode' => 'Resi Office Address Pincode',
            'resi_office_address_trigger' => 'Resi Office Address Trigger',
            'resi_office_address_lat' => 'Resi Office Address Lat',
            'resi_office_address_long' => 'Resi Office Address Long',
            'builder_profile_address' => 'Builder Profile Address',
            'builder_profile_address_verification' => 'Builder Profile Address Verification',
            'builder_profile_address_pincode' => 'Builder Profile Address Pincode',
            'builder_profile_address_trigger' => 'Builder Profile Address Trigger',
            'builder_profile_address_lat' => 'Builder Profile Address Lat',
            'builder_profile_address_long' => 'Builder Profile Address Long',
            'property_apf_address' => 'Property Apf Address',
            'property_apf_address_verification' => 'Property Apf Address Verification',
            'property_apf_address_pincode' => 'Property Apf Address Pincode',
            'property_apf_address_trigger' => 'Property Apf Address Trigger',
            'property_apf_address_lat' => 'Property Apf Address Lat',
            'property_apf_address_long' => 'Property Apf Address Long',
            'indiv_property_address' => 'Indiv Property Address',
            'indiv_property_address_verification' => 'Indiv Property Address Verification',
            'indiv_property_address_pincode' => 'Indiv Property Address Pincode',
            'indiv_property_address_trigger' => 'Indiv Property Address Trigger',
            'indiv_property_address_lat' => 'Indiv Property Address Lat',
            'indiv_property_address_long' => 'Indiv Property Address Long',
            'noc_soc_address' => 'Noc Soc Address',
            'noc_soc_address_verification' => 'Noc Soc Address Verification',
            'noc_soc_address_pincode' => 'Noc Soc Address Pincode',
            'noc_soc_address_trigger' => 'Noc Soc Address Trigger',
            'noc_soc_address_lat' => 'Noc Soc Address Lat',
            'noc_soc_address_long' => 'Noc Soc Address Long',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
            'company_name' => 'Company Name',
            'address' => 'Address',
        ];
    }

}
