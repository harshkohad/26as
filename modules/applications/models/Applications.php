<?php

namespace app\modules\applications\models;

use app\modules\applications\models\Institutes;
use app\modules\applications\models\LoanTypes;
use app\modules\applications\models\Area;
use app\modules\applications\models\ApplicationsVerifiers;
use app\modules\manage_mobile_app\models\TblMobileUsers;
use Yii;

/**
 * This is the model class for table "tbl_applications".
 *
 * @property integer $id
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
 * @property string $company_name
 * @property string $address
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
 * @property string $busi_tpc_neighbor_1
 * @property string $busi_tpc_neighbor_2
 * @property string $busi_company_name_board
 * @property string $busi_met_person
 * @property string $busi_designation
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
 * @property string $busi_structure
 * @property string $busi_remarks
 * @property integer $busi_status
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
 * @property string $resi_office_society_name_plate
 * @property string $resi_office_door_name_plate
 * @property string $resi_office_tpc_neighbor_1
 * @property string $resi_office_tpc_neighbor_2
 * @property string $resi_office_met_person
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
 * @property string $noc_soc_met_person
 * @property string $noc_soc_met_person_designation
 * @property string $noc_soc_signature_done_by
 * @property string $noc_soc_bldg_reg_number
 * @property integer $noc_soc_society_type
 * @property string $noc_soc_previous_owner
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
 * @property integer $update_by
 * @property string $updated_on
 * @property integer $is_deleted
 * @property string $resi_rented_owner_name
 * @property string $resi_rent_amount
 * @property string $busi_rented_owner_name
 * @property string $busi_rent_amount
 * @property string $resi_office_rented_owner_name
 * @property string $resi_office_rent_amount
 */
class Applications extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_applications';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['first_name', 'last_name', 'date_of_application', 'applicant_type', 'profile_type', 'institute_id', 'loan_type_id', 'date_of_birth', 'aadhaar_card_no', 'pan_card_no', 'mobile_no', 'alternate_contact_no', 'case_id', 'branch', 'company_name', 'address'], 'required'],
            [['profile_id', 'institute_id', 'loan_type_id', 'applicant_type', 'profile_type', 'area_id', 'resi_home_area', 'resi_stay_years', 'resi_total_family_members', 'resi_working_members', 'resi_locality', 'busi_staff_declared', 'busi_staff_seen', 'busi_years_in_business', 'busi_type_of_business', 'busi_area', 'busi_locality', 'office_employment_years', 'application_status', 'resi_relation', 'resi_ownership_status', 'busi_ownership_status', 'builder_profile_type_of_office', 'resi_office_ownership_status', 'resi_office_locality', 'property_apf_property_status', 'indiv_property_property_type', 'noc_soc_society_type', 'created_by', 'update_by', 'is_deleted', 'resi_market_feedback', 'resi_status', 'busi_status', 'office_status', 'noc_status', 'busi_is_reachable', 'resi_is_reachable', 'office_is_reachable', 'resi_office_is_reachable', 'builder_profile_is_reachable', 'property_apf_is_reachable', 'indiv_property_is_reachable', 'noc_soc_is_reachable', 'noc_is_reachable'], 'integer'],
            [['date_of_application', 'financial_date_of_filing', 'bank_dated_transaction', 'bank_account_opening_date', 'bank_date_of_birth', 'resi_address_pincode', 'office_address_pincode', 'busi_address_pincode', 'noc_address_pincode', 'resi_office_address_pincode', 'builder_profile_address_pincode', 'property_apf_address_pincode', 'indiv_property_address_pincode', 'noc_soc_address_pincode', 'created_on', 'updated_on', 'application_id', 'resi_rented_owner_name', 'resi_rent_amount', 'busi_rented_owner_name', 'busi_rent_amount', 'resi_office_rented_owner_name', 'resi_office_rent_amount','pan_first_name','pan_last_name'
                ,'pan_middle_name','pan_address','pan_pan_no','pan_dob','pan_date_of_issue','pan_is_complete','ac_first_name','ac_last_name','ac_middle_name','ac_aadhar_no','ac_dob','ac_address','ac_mobile_no','ac_is_complete','passport_first_name','passport_last_name','passport_middle_name','passport_passport_no','passport_passport_no','passport_address','passport_validity','passport_date_of_issue','passport_is_complete',
                'electricity_name','electricity_address','electricity_is_complete','telephone_is_complete','telephone_mobile_no','telephone_amount','telephone_name','telephone_address','voter_first_name','voter_last_name','voter_middle_name','voter_address','voter_voter_id_no','voter_is_complete','driving_is_complete','driving_name','driving_driving_license_number','driving_validity','driving_date_of_issue','company_is_complete','company_name','company_designation',
                'shop_act_is_complete','shop_act_name','shop_act_shop_act_no','shop_act_address','shop_act_from_date','shop_act_till_date','gst_name','gst_is_complete','gst_gst_no','gst_address','rent_aggeement_met_name','rent_aggeement_owner_name','rent_aggeement_rent_amount','rent_aggeement_deposit_amount','rent_aggeement_is_complete','rent_aggeement_validity','seller_is_complete','seller_name','seller_purchaser_name','seller_address','oc_cc_plan_cts_no','oc_cc_plan_is_complete','oc_cc_plan_issuing_authority',
                'oc_cc_plan_signature','ocr_receipt_builder_name','ocr_receipt_met_person','ocr_receipt_designation','ocr_receipt_signature','ocr_receipt_tpc','ocr_receipt_landmark','ocr_receipt_amount','ocr_receipt_receipt_no','ocr_receipt_is_complete','noc_soc_chairman_name','noc_soc_secretary_name','noc_soc_tresurer_name'], 'safe'],
            [['first_name', 'middle_name', 'last_name', 'resi_society_name_plate', 'resi_door_name_plate', 'resi_tpc_neighbor_1', 'resi_tpc_neighbor_2', 'resi_met_person', 'resi_ownership_status_text', 'resi_landmark_1', 'resi_landmark_2', 'busi_tpc_neighbor_1', 'busi_tpc_neighbor_2', 'busi_company_name_board', 'busi_met_person', 'busi_designation', 'busi_nature_of_business', 'busi_ownership_status_text', 'busi_landmark_1', 'busi_landmark_2', 'office_company_name_board', 'office_designation', 'office_met_person', 'office_met_person_designation', 'office_department', 'office_nature_of_company', 'office_net_salary_amount', 'office_tpc_for_applicant', 'office_tpc_for_company', 'office_landmark', 'financial_pan_card_no', 'financial_name', 'financial_sales', 'financial_share_capital', 'financial_net_profit', 'financial_debtors', 'financial_creditors', 'financial_total_loans', 'financial_depriciation', 'bank_bank_name', 'bank_account_holder', 'bank_account_number', 'bank_pan_card_no', 'bank_current_balance', 'financial_assessment_year', 'resi_address', 'office_address', 'busi_address', 'noc_address', 'resi_address_trigger', 'office_address_trigger', 'busi_address_trigger', 'noc_address_trigger', 'resi_locality_text', 'busi_locality_text'], 'string', 'max' => 150],
            [['resi_remarks', 'busi_remarks', 'office_remarks', 'bank_address', 'bank_narration', 'resi_structure', 'busi_structure', 'office_structure', 'noc_structure', 'resi_office_structure', 'resi_office_remarks', 'builder_profile_current_projects', 'builder_profile_previous_projects', 'busi_address_trigger', 'resi_address', 'resi_address_trigger', 'office_address', 'office_address_trigger', 'busi_address', 'noc_address', 'noc_address_trigger', 'resi_office_address', 'resi_office_address_trigger', 'builder_profile_address', 'builder_profile_address_trigger', 'property_apf_address', 'property_apf_address_trigger', 'indiv_property_address', 'indiv_property_address_trigger', 'noc_soc_address', 'noc_soc_address_trigger'], 'string', 'max' => 1000],
            //['aadhaar_card_no', 'integer', 'max' => 12],
            ['busi_designation_others', 'string', 'max' => 100],
            ['aadhaar_card_no', 'match', 'pattern' => '/^[0-9-]+$/', 'skipOnError' => true],
            ['aadhaar_card_no', 'validateAAdharCard'],
            ['pan_card_no', 'validatePanCard'],
                //[['resi_address_pincode', 'office_address_pincode', 'busi_address_pincode', 'noc_address_pincode', 'resi_office_address_pincode', 'builder_profile_address_pincode', 'property_apf_address_pincode', 'indiv_property_address_pincode', 'noc_soc_address_pincode'], 'string', 'max' => 10],
        ];
    }

    public function validateAAdharCard($attribute, $params) {
        if (strlen($this->aadhaar_card_no) != 12) {
            $this->addError($attribute, 'Invalid Aadhar Card.');
            return false;
        }
    }

    public function validatePanCard($attribute, $params) {

        $pattern = '/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/';
        if (!empty($this->pan_card_no)) {
            $result = preg_match($pattern, $this->pan_card_no);
            if ($result) {
                $findme = ucfirst(substr($this->pan_card_no, 3, 1));
                $mystring = 'CPHFATBLJG';
                $pos = strpos($mystring, $findme);
                if ($pos === false) {
                    $this->addError($attribute, 'Invalid Pan Card.');
                    return FALSE;
                }
            } else {
                $this->addError($attribute, 'Invalid Pan Card.');
                return FALSE;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'ocr_receipt_builder_name' => "Builder Name",
            'ocr_receipt_met_person' => "Met Person",
            'ocr_receipt_designation' => "Designation",
            'ocr_receipt_amount' => "Amount",
            'ocr_receipt_receipt_no' => "Receipt No",
            'ocr_receipt_signature' => "Signature",
            'ocr_receipt_tpc' => "TPC",
            'ocr_receipt_landmark' => "Landmark",
            'oc_cc_plan_cts_no' => "CTS No",
            'oc_cc_plan_issuing_authority' => "Issuing Authority",
            'oc_cc_plan_signature' => "Signature",
            'seller_name' => "Name",
            'seller_purchaser_name' => "Purchaser Name",
            'seller_address' => "Address",
            'rent_aggeement_met_name' => "Met Name",
            'rent_aggeement_owner_name' => "Owner Name",
            'rent_aggeement_rent_amount' => "Rent Amount",
            'rent_aggeement_validity' => "Validity",
            'rent_aggeement_deposit_amount' => "Deposit Amount",
            'gst_name' => "Name",
            'gst_gst_no' => "GST No",
            'gst_address' => "Address",
            'shop_act_name' => "Name",
            'shop_act_shop_act_no' => "Shop Act No",
            'shop_act_address' => "Address",
            'shop_act_from_date' => "From Date",
            'shop_act_till_date' => "Till Date",
            'company_name' => "Name",
            'company_designation' => "Designation",
            'driving_name' => "Name",
            'driving_date_of_issue' => "Date of Issue",
            'driving_valifity' => "Validity",
            'driving_driving_license_number' => "Driving License No",
            'pan_first_name' => 'First Name',
            'pan_middle_name' => 'Middle Name',
            'pan_last_name' => 'Last Name',
            'pan_pan_no' => 'PAN Number',
            'pan_dob' => 'DOB',
            'pan_date_of_issue' => 'Date of Issue',
            'pan_address' => 'Address',
            'ac_first_name' => 'First Name',
            'ac_middle_name' => 'Middle Name',
            'ac_last_name' => 'Last Name',
            'ac_aadhar_no' => 'Aadhar Number',
            'ac_dob' => 'DOB',
            'ac_address' => 'Address',
            'ac_mobile_no' => 'Mobile No',
            'passport_first_name' => 'First Name',
            'passport_middle_name' => 'Middle Name',
            'passport_last_name' => 'Last Name',
            'passport_passport_no' => 'Passport No',
            'passport_passport_no' => 'Passport No',
            'passport_address' => 'Address',
            'passport_date_of_issue' => 'Date Of Issue',
            'electricity_address' => 'Address',
            'electricity_name' => 'Name',
            'telephone_mobile_no' => 'Mobile No',
            'telephone_name' => 'Name',
            'telephone_address' => 'Address',
            'telephone_amount' => 'Amount',
            'voter_first_name' => 'First Name',
            'voter_middle_name' => 'Middle Name',
            'voter_last_name' => 'Last Name',
            'voter_voter_id_no' => 'Voter ID No',
            'voter_address' => 'Address',
            'application_id' => 'Application ID',
            'profile_id' => 'Profile ID',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'date_of_birth' => 'Date of birth',
            'aadhaar_card_no' => 'Aadhaar Card No',
            'pan_card_no' => 'Pan Card No',
            'mobile_no' => 'Mobile No',
            'alternate_contact_no' => 'Alternate Contact No',
            'case_id' => 'Case Id',
            'branch' => 'Branch Name',
            'institute_id' => 'Institute Name',
            'loan_type_id' => 'Loan Type',
            'applicant_type' => 'Applicant Type',
            'profile_type' => 'Profile Type',
            'area_id' => 'Area',
            'date_of_application' => 'Date Of Application',
            'company_name' => 'Company Name',
            'address' => 'Address',
            'resi_society_name_plate' => 'Society Name Plate',
            'resi_door_name_plate' => 'Door Name Plate',
            'resi_tpc_neighbor_1' => 'Tpc Neighbor 1',
            'resi_tpc_neighbor_2' => 'Tpc Neighbor 2',
            'resi_met_person' => 'Met Person',
            'resi_relation' => 'Relation',
            'resi_home_area' => 'Home Area',
            'resi_ownership_status' => 'Address type',
            'resi_ownership_status_text' => 'Address type Other',
            'resi_stay_years' => 'Stay Years',
            'resi_total_family_members' => 'Total Family Members',
            'resi_working_members' => 'Working Members',
            'resi_locality' => 'Locality',
            'resi_locality_text' => 'Locality Other',
            'resi_landmark_1' => 'Landmark 1',
            'resi_landmark_2' => 'Landmark 2',
            'resi_structure' => 'Structure',
            'resi_market_feedback' => 'Market Feedback',
            'resi_remarks' => 'Remarks',
            'resi_status' => 'Status',
            'busi_tpc_neighbor_1' => 'Tpc Neighbor 1',
            'busi_tpc_neighbor_2' => 'Tpc Neighbor 2',
            'busi_company_name_board' => 'Company Name Board',
            'busi_met_person' => 'Met Person',
            'busi_designation' => 'Designation',
            'busi_nature_of_business' => 'Nature Of Business',
            'busi_staff_declared' => 'Staff Declared',
            'busi_staff_seen' => 'Staff Seen',
            'busi_years_in_business' => 'Years In Business',
            'busi_type_of_business' => 'Type Of Business',
            'busi_ownership_status' => 'Address type',
            'busi_ownership_status_text' => 'Address type Other',
            'busi_area' => 'Area',
            'busi_locality' => 'Locality',
            'busi_locality_text' => 'Locality Other',
            'busi_landmark_1' => 'Landmark 1',
            'busi_landmark_2' => 'Landmark 2',
            'busi_structure' => 'Structure',
            'busi_remarks' => 'Remarks',
            'busi_status' => 'Status',
            'office_company_name_board' => 'Company Name Board',
            'office_designation' => 'Applicant Designation',
            'office_met_person' => 'Met Person',
            'office_met_person_designation' => 'Met Person Designation',
            'office_department' => 'Department',
            'office_nature_of_company' => 'Nature Of Company',
            'office_employment_years' => 'Employment Years',
            'office_net_salary_amount' => 'Net Salary Amount',
            'office_tpc_for_applicant' => 'Tpc For Applicant',
            'office_tpc_for_company' => 'Tpc For Company',
            'office_landmark' => 'Landmark',
            'office_structure' => 'Structure',
            'office_remarks' => 'Remarks',
            'office_status' => 'Status',
            'financial_pan_card_no' => 'Pan Card No',
            'financial_name' => 'Name',
            'financial_assessment_year' => 'Assessment Year',
            'financial_date_of_filing' => 'Date Of Filing',
            'financial_sales' => 'Sales',
            'financial_share_capital' => 'Share Capital',
            'financial_net_profit' => 'Net Profit',
            'financial_debtors' => 'Debtors',
            'financial_creditors' => 'Creditors',
            'financial_total_loans' => 'Total Loans',
            'financial_depriciation' => 'Depriciation',
            'bank_bank_name' => 'Bank Name',
            'bank_account_holder' => 'Account Holder',
            'bank_account_number' => 'Account Number',
            'bank_dated_transaction' => 'Dated Transaction',
            'bank_pan_card_no' => 'Pan Card No',
            'bank_current_balance' => 'Current Balance',
            'bank_account_opening_date' => 'Account Opening Date',
            'bank_date_of_birth' => 'Date Of Birth',
            'bank_address' => 'Address',
            'bank_narration' => 'Narration',
            'noc_structure' => 'Structure',
            'noc_status' => 'Status',
            'resi_office_society_name_plate' => 'Society Name Plate',
            'resi_office_door_name_plate' => 'Door Name Plate',
            'resi_office_tpc_neighbor_1' => 'Tpc Neighbor 1',
            'resi_office_tpc_neighbor_2' => 'Tpc Neighbor 2',
            'resi_office_met_person' => 'Met Person',
            'resi_office_met_person_designation' => 'Met Person Designation',
            'resi_office_relation' => 'Relation',
            'resi_office_home_area' => 'Home Area',
            'resi_office_ownership_status' => 'Address type',
            'resi_office_ownership_status_text' => 'Address type Others',
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
            'resi_office_locality_text' => 'Locality Others',
            'resi_office_landmark_1' => 'Landmark 1',
            'resi_office_landmark_2' => 'Landmark 2',
            'resi_office_structure' => 'Structure',
            'resi_office_market_feedback' => 'Market Feedback',
            'resi_office_remarks' => 'Remarks',
            'resi_office_status' => 'Status',
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
            'property_apf_met_person' => 'Met Person',
            'property_apf_met_person_designation' => 'Met Person Designation',
            'property_apf_property_status' => 'Property Status',
            'property_apf_no_of_workers' => 'No Of Workers',
            'property_apf_mode_of_payment' => 'Mode Of Payment',
            'property_apf_construction_stock' => 'Construction Stock',
            'property_apf_total_flats' => 'Total Flats',
            'property_apf_how_many_sold' => 'How Many Sold',
            'property_apf_total_shops' => 'Total Shops',
            'property_apf_area' => 'Area',
            'property_apf_work_completed' => 'Work Completed',
            'property_apf_possession' => 'Possession',
            'property_apf_apf' => 'Apf',
            'property_apf_delay_in_work' => 'Delay In Work',
            'property_apf_tpc' => 'Tpc',
            'property_apf_landmark' => 'Landmark',
            'indiv_property_met_person' => 'Met Person',
            'indiv_property_met_person_designation' => 'Met Person Designation',
            'indiv_property_property_confirmed' => 'Property Confirmed',
            'indiv_property_previous_owner' => 'Previous Owner',
            'indiv_property_property_type' => 'Property Type',
            'indiv_property_area' => 'Area',
            'indiv_property_approx_market_value' => 'Approx Market Value',
            'indiv_property_society_name_plate' => 'Society Name Plate',
            'indiv_property_door_name_plate' => 'Door Name Plate',
            'indiv_property_tpc' => 'Tpc',
            'indiv_property_landmark' => 'Landmark',
            'noc_soc_met_person' => 'Met Person',
            'noc_soc_met_person_designation' => 'Met Person Designation',
            'noc_soc_signature_done_by' => 'Signature Done By',
            'noc_soc_bldg_reg_number' => 'Building Reg. No.',
            'noc_soc_society_type' => 'Society Type',
            'noc_soc_previous_owner' => 'Previous Owner',
            'application_status' => 'Application Status',
            'mobile_user_id' => 'Mobile User',
            'mobile_user_assigned_date' => 'Mobile User Assigned Date',
            'mobile_user_status' => 'Mobile User Status',
            'mobile_user_status_updated_on' => 'Mobile User Status Updated On',
            'resi_address' => 'Residence Address',
            'resi_address_verification' => 'Send For Verification',
            'resi_address_pincode' => 'Residence Pincode',
            'resi_address_trigger' => 'Residence Triggers',
            'office_address' => 'Office Address',
            'office_address_verification' => 'Send For Verification',
            'office_address_pincode' => 'Office Pincode',
            'office_address_trigger' => 'Office Triggers',
            'busi_address' => 'Business Address',
            'busi_address_verification' => 'Send For Verification',
            'busi_address_pincode' => 'Business Pincode',
            'busi_address_trigger' => 'Business Triggers',
            'noc_address' => 'NOC (Business/Conditional) Address',
            'noc_address_verification' => 'Send For Verification',
            'noc_address_pincode' => 'NOC (Business/Conditional) Pincode',
            'noc_address_trigger' => 'NOC (Business/Conditional) Triggers',
            'resi_office_address' => 'Residence/Office Address',
            'resi_office_address_verification' => 'Send For Verification',
            'resi_office_address_pincode' => 'Residence/Office Pincode',
            'resi_office_address_trigger' => 'Residence/Office Trigger',
            'builder_profile_address' => 'Builder Profile Address',
            'builder_profile_address_verification' => 'Send For Verification',
            'builder_profile_address_pincode' => 'Builder Profile Pincode',
            'builder_profile_address_trigger' => 'Builder Profile Trigger',
            'property_apf_address' => 'Property(APF) Address',
            'property_apf_address_verification' => 'Send For Verification',
            'property_apf_address_pincode' => 'Property(APF) Pincode',
            'property_apf_address_trigger' => 'Property(APF) Trigger',
            'indiv_property_address' => 'Individual Property Address',
            'indiv_property_address_verification' => 'Send For Verification',
            'indiv_property_address_pincode' => 'Individual Property Pincode',
            'indiv_property_address_trigger' => 'Individual Property Trigger',
            'noc_soc_address' => 'NOC (Society) Address',
            'noc_soc_address_verification' => 'Send For Verification',
            'noc_soc_address_pincode' => 'NOC (Society) Pincode',
            'noc_soc_address_trigger' => 'NOC (Society) Trigger',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'update_by' => 'Update By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
            'resi_rented_owner_name' => 'Rent Owner Name',
            'resi_rent_amount' => 'Rent Amount',
            'busi_rented_owner_name' => 'Rent Owner Name',
            'busi_rent_amount' => 'Rent Amount',
            'resi_office_rented_owner_name' => 'Rent Owner Name',
            'resi_office_rent_amount' => 'Rent Amount',
            'busi_is_reachable' => 'Is Reachable',
            'resi_is_reachable' => 'Is Reachable',
            'office_is_reachable' => 'Is Reachable',
            'resi_office_is_reachable' => 'Is Reachable',
            'builder_profile_is_reachable' => 'Is Reachable',
            'property_apf_is_reachable' => 'Is Reachable',
            'indiv_property_is_reachable' => 'Is Reachable',
            'noc_soc_is_reachable' => 'Is Reachable',
            'noc_is_reachable' => 'Is Reachable',
            'busi_designation_others' => 'Designation Others',
            'noc_soc_chairman_name' => 'Chairman Name',
            'noc_soc_secretary_name' => 'Secretary Name',
            'noc_soc_tresurer_name' => 'Tresurer Name',
        ];
    }

    public function getApplicantName($first_name, $middle_name, $last_name) {
        return $first_name . ' ' . $middle_name . ' ' . $last_name;
    }

    public function getLoanType($loan_type_id) {
        $return = '';

        $loan_data = LoanTypes::findOne($loan_type_id);

        if (!empty($loan_data)) {
            $return = $loan_data->loan_name;
        }

        return $return;
    }

    public function getInstituteNameType($institute_id) {
        $return = '';

        $institutes = Institutes::findOne($institute_id);

        if (!empty($institutes)) {
            $return = $institutes->name;
        }

        return $return;
    }

    public function getApplicantType($applicant_type) {
        $return = '';

        switch ($applicant_type) {
            case 1:
                $return = 'Salaried';
                break;
            case 2:
                $return = 'Self-employed';
                break;
        }

        return $return;
    }

    public function getProfileType($profile_type) {
        $return = '';

        switch ($profile_type) {
            case 1:
                $return = 'Resi';
                break;
            case 2:
                $return = 'Office';
                break;
            case 3:
                $return = 'Resi/Office';
                break;
        }

        return $return;
    }

    public function getAreaName($area_id) {
        $return = '';

        $area = Area::find($area_id)->one();

        if (!empty($area)) {
            $return = $area->name;
        }

        return $return;
    }

    public function getOwnershipStatus($status_id) {
        $return = '';

        switch ($status_id) {
            case 1:
                $return = 'Rented';
                break;
            case 2:
                $return = 'Owned';
                break;
            case 3:
                $return = 'Parental';
                break;
            case 4:
                $return = 'Other';
                break;
        }

        return $return;
    }

    public function getResiLocality($locality) {
        $return = '';

        switch ($locality) {
            case 1:
                $return = 'Chawl';
                break;
            case 2:
                $return = 'Building';
                break;
            case 3:
                $return = 'Bunglow';
                break;
            case 4:
                $return = 'Other';
                break;
        }

        return $return;
    }

    public function getBusiType($busi_type) {
        $return = '';

        switch ($busi_type) {
            case 1:
                $return = 'DIRECTORSHIP';
                break;
            case 2:
                $return = 'PROPRIETOR';
                break;
            case 3:
                $return = 'PARTNERSHIP';
                break;
        }

        return $return;
    }

    public function getBusiLocality($locality) {
        $return = '';

        switch ($locality) {
            case 1:
                $return = 'Gala';
                break;
            case 2:
                $return = 'Shopline';
                break;
            case 3:
                $return = 'Compound';
                break;
            case 4:
                $return = 'Resi';
                break;
            case 5:
                $return = 'Commercial';
                break;
            case 6:
                $return = 'Other';
                break;
        }

        return $return;
    }

    public function getOfficeType($office_type) {
        $return = '';

        switch ($office_type) {
            case 1:
                $return = 'Shopline';
                break;
            case 2:
                $return = 'Commercial';
                break;
            case 3:
                $return = 'Independent';
                break;
            case 4:
                $return = 'Residential';
                break;
        }

        return $return;
    }

    public function getPropertyStatus($property_status) {
        $return = '';

        switch ($property_status) {
            case 1:
                $return = 'Freshland';
                break;
            case 2:
                $return = 'Redevelopment';
                break;
        }

        return $return;
    }

    public function getPropertyType($property_type) {
        $return = '';

        switch ($property_type) {
            case 1:
                $return = 'Fresh Property';
                break;
            case 2:
                $return = 'Old Sold Out';
                break;
        }

        return $return;
    }

    public function getSocietyType($society_type) {
        $return = '';

        switch ($society_type) {
            case 1:
                $return = 'Housing';
                break;
            case 2:
                $return = 'Mhada';
                break;
            case 3:
                $return = 'Chawl Society';
                break;
        }

        return $return;
    }

    public function getApplicationStatus($id, $application_status) {
        $return = '';

        $verifiers_data = ApplicationsVerifiers::find()->where(['application_id' => $id, 'is_deleted' => '0'])->all();
        if ($application_status == 3) {
            $return = '<span style="color:#00a65a;font-weight:bold">Completed</span>';
        } elseif (!empty($verifiers_data) OR $application_status == 2) {
            $return = '<span style="color:#d58512;font-weight:bold">Inprogress</span>';
        } else {
            $return = '<span style="color:#3c8dbc;font-weight:bold">New</span>';
        }
        if ($application_status != 3) {
            $return .= '<div style="clear:both;"><button type="button" class="btn btn-block btn-primary btn-sm change_application_status" value="' . $id . '" rel="' . $application_status . '">Change Status</button></div>';
        } else {
            $return .= '<div style="clear:both;"><button type="button" class="btn btn-block btn-primary btn-sm revisit_application" value="' . $id . '">Revisit</button></div>';
        }
//        switch ($application_status) {
//            case 1:
//                $return = '<span style="color:#3c8dbc;font-weight:bold">New</span>';
//                break;
//            case 2:
//                $return = '<span style="color:#d58512;font-weight:bold">Inprogress</span>';
//                break;
//            case 3:
//                $return = '<span style="color:#00a65a;font-weight:bold">Completed</span>';
//                break;
//        }

        return $return;
    }

    public function getVerifierStatus($id, $application_status) {
        $return = '';

        if ($application_status == 1 || $application_status == 2) {
            $assignable_count = 0;
            $applications_model = Applications::findOne($id);
            if ($applications_model->resi_address_verification == 1 ||
                    $applications_model->busi_address_verification == 1 ||
                    $applications_model->office_address_verification == 1 ||
                    $applications_model->noc_address_verification == 1 ||
                    $applications_model->resi_office_address_verification == 1 ||
                    $applications_model->builder_profile_address_verification == 1 ||
                    $applications_model->property_apf_address_verification == 1 ||
                    $applications_model->indiv_property_address_verification == 1 ||
                    $applications_model->noc_soc_address_verification == 1
            ) {
                if ($applications_model->resi_address_verification == 1) {
                    $assignable_count++;
                }
                if ($applications_model->busi_address_verification == 1) {
                    $assignable_count++;
                }
                if ($applications_model->office_address_verification == 1) {
                    $assignable_count++;
                }
                if ($applications_model->noc_address_verification == 1) {
                    $assignable_count++;
                }
                if ($applications_model->resi_office_address_verification == 1) {
                    $assignable_count++;
                }
                if ($applications_model->builder_profile_address_verification == 1) {
                    $assignable_count++;
                }
                if ($applications_model->property_apf_address_verification == 1) {
                    $assignable_count++;
                }
                if ($applications_model->indiv_property_address_verification == 1) {
                    $assignable_count++;
                }
                if ($applications_model->noc_soc_address_verification == 1) {
                    $assignable_count++;
                }
            }
            $verifiers_data = ApplicationsVerifiers::find()->where(['application_id' => $id, 'is_deleted' => '0'])->all();

            $count = 0;
            if (!empty($verifiers_data)) {
                foreach ($verifiers_data as $verifier_data) {
                    $count++;
                }
            }

            $return = '<div><span style="color:#3c8dbc;font-weight:bold">Assignable : ' . $assignable_count . '</span><br><span style="color:#00a65a;font-weight:bold">Assigned : ' . $count . '</span></div><div style="clear:both;"><button type="button" class="btn btn-block btn-primary btn-sm manageVerifier" value="' . $id . '">Manage Verifiers</button></div>';
//        switch ($verifier_status) {
//            case 0:
//                $return = '<button type="button" class="btn btn-block btn-primary btn-sm assignVerifier" value="'.$id.'">Assign Verifier</button>';
//                break;
//            case 1:
//                $return = '<span style="color:#3c8dbc;font-weight:bold">New</span>';
//                break;
//            case 2:
//                $return = '<span style="color:#d58512;font-weight:bold">Inprogress</div>';
//                break;
//            case 3:
//                $return = '<span style="color:#00a65a;font-weight:bold">Completed</div>';
//                break;
//        }
        } else {
            $return = '<span style="color:#e70606;font-weight:bold">NA</span>';
        }

        return $return;
    }

    function thumbnailCreator($newfile_name, $dirname, $thumbs_folder_name, $thumb_width, $thumb_height, $file_tmp, $file_ext) {
        //upload image path
        $upload_image = $dirname . '/' . $newfile_name;

        $thumbnail = $dirname . '/' . $thumbs_folder_name . '/' . $newfile_name;
        list($width, $height) = getimagesize($upload_image);
        $thumb_create = imagecreatetruecolor($thumb_width, $thumb_height);
        switch ($file_ext) {
            case 'jpg':
                $source = imagecreatefromjpeg($upload_image);
                break;
            case 'jpeg':
                $source = imagecreatefromjpeg($upload_image);
                break;
            case 'png':
                $source = imagecreatefrompng($upload_image);
                break;
            case 'gif':
                $source = imagecreatefromgif($upload_image);
                break;
            default:
                $source = imagecreatefromjpeg($upload_image);
        }

        imagecopyresized($thumb_create, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
        switch ($file_ext) {
            case 'jpg' || 'jpeg':
                imagejpeg($thumb_create, $thumbnail, 100);
                break;
            case 'png':
                imagepng($thumb_create, $thumbnail, 100);
                break;

            case 'gif':
                imagegif($thumb_create, $thumbnail, 100);
                break;
            default:
                imagejpeg($thumb_create, $thumbnail, 100);
        }
    }

    public static function getLatLong($pincode, $address) {
        $pincode_data = PincodeMaster::find()->where(['pincode' => $pincode])->one();

        if (!empty($pincode_data)) {
            $po_name = $pincode_data->po_name;
            $city_name = $pincode_data->city_name;
            $state_name = $pincode_data->state_name;

            $full_address = $address . ',' . $city_name . ',' . $state_name . ',' . $pincode;

            if (!empty($full_address)) {
                //Formatted address
                $formattedAddr = str_replace(' ', '+', $full_address);

                $arrContextOptions = array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                    ),
                );

                //Send request and receive json data by address
                $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddr . '&sensor=false&region=India&key=' . Yii::$app->params['GOOGLE_MAPS_API_KEY'], false, stream_context_create($arrContextOptions));
                $output = json_decode($geocodeFromAddr);
                //Get latitude and longitute from json data
                if (!empty($output->results)) {
                    $data['latitude'] = $output->results[0]->geometry->location->lat;
                    $data['longitude'] = $output->results[0]->geometry->location->lng;
                    //Return latitude and longitude of the given address
                    if (!empty($data)) {
                        return $data;
                    }
                }
            }
        }
    }

    public function getRelationName($relation_id) {
        $relations = ['1' => 'Self', '2' => 'Father', '3' => 'Mother', '4' => 'Brother', '5' => 'Wife', '6' => 'Son', '7' => 'Daughter', '8' => 'Grandfather', '9' => 'Grand Mother', '10' => 'Uncle', '11' => 'Aunt', '12' => 'Cousin', '13' => 'Employee', '14' => 'Neighbour', '15' => 'Security Guard', '16' => 'NA'];
        if (!empty($relation_id)) {
            if (isset($relations[$relation_id])) {
                return $relations[$relation_id];
            }
            return "";
        }
    }

    public function getDesignation($designation_id) {
        $designations = ['1' => 'Self', '2' => 'Manager', '3' => 'Accountant', '4' => 'HR', '5' => 'Staff', '6' => 'Security', '6' => 'Others'];
        if (!empty($designation_id)) {
            if (isset($designations[$designation_id])) {
                return $designations[$designation_id];
            }
            return "";
        }
    }

    public function verificationStatus($id, $type) {
        $return_data = '';
        #get data
        $query = "SELECT * FROM view_all_sites WHERE app_id = $id and verification_type_id = $type";
        $table_data = \Yii::$app->getDb()->createCommand($query)->queryOne();
        $tag = '';
        if (!empty($table_data)) {
            $verifier_data = TblMobileUsers::find($table_data['mobile_user_id'])->one();
            switch ($table_data['mobile_user_status']) {
                case 1:
                    $tag = '<div style="float:right;"><span class="badge bg-purple">IN PROGRESS</span> : ' . $verifier_data->field_agent_name . '</div>';
                    break;
                case 2:
                    $tag = '<div style="float:right;"><span class="badge" style="background: #a9d86e !important;">COMPLETED</span> : ' . $verifier_data->field_agent_name . '</div>';
                    break;
                default :
                    $tag = '<div style="float:right;"><span class="badge" style="background: #FCB322 !important;">ASSIGNED</span> : ' . $verifier_data->field_agent_name . '</div>';
                    break;
            }
            $return_data = $tag;
        }
        if (empty($tag)) {
            $return_data = '<div style="float:right;"><span class="badge" style="background: #ff6c60 !important;">NOT-ASSIGNED</span></div>';
        }

        return $return_data;
    }

}
