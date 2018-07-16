<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_applications_history".
 *
 * @property integer $id
 * @property integer $previous_id
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
 * @property integer $application_status
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
 * @property string $pan_first_name
 * @property string $pan_last_name
 * @property string $pan_middle_name
 * @property string $pan_address
 * @property string $pan_pan_no
 * @property string $pan_dob
 * @property string $pan_date_of_issue
 * @property integer $pan_is_complete
 * @property integer $pan_feedback
 * @property string $ac_first_name
 * @property string $ac_last_name
 * @property string $ac_middle_name
 * @property string $ac_aadhar_no
 * @property string $ac_dob
 * @property string $ac_address
 * @property integer $ac_mobile_no
 * @property integer $ac_is_complete
 * @property integer $ac_feedback
 * @property string $passport_first_name
 * @property string $passport_last_name
 * @property string $passport_middle_name
 * @property string $passport_passport_no
 * @property string $passport_address
 * @property string $passport_validity
 * @property string $passport_date_of_issue
 * @property integer $passport_is_complete
 * @property integer $passport_feedback
 * @property string $electricity_name
 * @property string $electricity_address
 * @property string $electricity_is_complete
 * @property integer $electricity_feedback
 * @property integer $telephone_mobile_no
 * @property integer $telephone_amount
 * @property string $telephone_name
 * @property string $telephone_address
 * @property integer $telephone_is_complete
 * @property integer $telephone_feedback
 * @property string $voter_first_name
 * @property string $voter_last_name
 * @property string $voter_middle_name
 * @property string $voter_address
 * @property integer $voter_voter_id_no
 * @property integer $voter_is_complete
 * @property integer $voter_feedback
 * @property string $driving_name
 * @property string $driving_driving_license_number
 * @property string $driving_validity
 * @property string $driving_date_of_issue
 * @property integer $driving_is_complete
 * @property integer $driving_feedback
 * @property string $company_id_name
 * @property string $company_id_designation
 * @property integer $company_id_is_complete
 * @property integer $company_id_feedback
 * @property string $shop_act_name
 * @property string $shop_act_shop_act_no
 * @property string $shop_act_address
 * @property string $shop_act_from_date
 * @property string $shop_act_till_date
 * @property integer $shop_act_is_complete
 * @property integer $shop_act_feedback
 * @property string $gst_name
 * @property integer $gst_gst_no
 * @property string $gst_address
 * @property integer $gst_is_complete
 * @property integer $gst_feedback
 * @property string $rent_agreement_met_name
 * @property string $rent_agreement_owner_name
 * @property integer $rent_agreement_rent_amount
 * @property integer $rent_agreement_deposit_amount
 * @property string $rent_agreement_validity
 * @property integer $rent_agreement_is_complete
 * @property integer $rent_agreement_feedback
 * @property string $sale_agreement_seller_name
 * @property string $sale_agreement_purchaser_name
 * @property string $sale_agreement_address
 * @property integer $sale_agreement_is_complete
 * @property integer $sale_agreement_feedback
 * @property integer $oc_cc_plan_cts_no
 * @property string $oc_cc_plan_issuing_authority
 * @property string $oc_cc_plan_signature
 * @property integer $oc_cc_plan_is_complete
 * @property integer $oc_cc_plan_feedback
 * @property string $ocr_receipt_builder_name
 * @property string $ocr_receipt_met_person
 * @property string $ocr_receipt_designation
 * @property string $ocr_receipt_signature
 * @property string $ocr_receipt_tpc
 * @property string $ocr_receipt_landmark
 * @property integer $ocr_receipt_amount
 * @property integer $ocr_receipt_receipt_no
 * @property integer $ocr_receipt_is_complete
 * @property integer $ocr_receipt_feedback
 * @property integer $version
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class ApplicationsHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_applications_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['previous_id', 'profile_id', 'pan_dob', 'pan_date_of_issue', 'ac_dob', 'passport_validity', 'passport_date_of_issue'], 'required'],
            [['previous_id', 'profile_id', 'institute_id', 'loan_type_id', 'applicant_type', 'profile_type', 'area_id', 'application_status', 'pan_is_complete', 'pan_feedback', 'ac_mobile_no', 'ac_is_complete', 'ac_feedback', 'passport_is_complete', 'passport_feedback', 'electricity_feedback', 'telephone_mobile_no', 'telephone_amount', 'telephone_is_complete', 'telephone_feedback', 'voter_voter_id_no', 'voter_is_complete', 'voter_feedback', 'driving_is_complete', 'driving_feedback', 'company_id_is_complete', 'company_id_feedback', 'shop_act_is_complete', 'shop_act_feedback', 'gst_gst_no', 'gst_is_complete', 'gst_feedback', 'rent_agreement_rent_amount', 'rent_agreement_deposit_amount', 'rent_agreement_is_complete', 'rent_agreement_feedback', 'sale_agreement_is_complete', 'sale_agreement_feedback', 'oc_cc_plan_cts_no', 'oc_cc_plan_is_complete', 'oc_cc_plan_feedback', 'ocr_receipt_amount', 'ocr_receipt_receipt_no', 'ocr_receipt_is_complete', 'ocr_receipt_feedback', 'version', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['date_of_birth', 'date_of_application', 'financial_assessment_year', 'financial_date_of_filing', 'bank_dated_transaction', 'bank_account_opening_date', 'bank_date_of_birth', 'pan_dob', 'pan_date_of_issue', 'ac_dob', 'passport_validity', 'passport_date_of_issue', 'driving_validity', 'driving_date_of_issue', 'shop_act_from_date', 'shop_act_till_date', 'rent_agreement_validity', 'created_on', 'updated_on'], 'safe'],
            [['telephone_address', 'sale_agreement_address'], 'string'],
            [['application_id', 'first_name', 'middle_name', 'last_name', 'aadhaar_card_no', 'pan_card_no', 'mobile_no', 'financial_pan_card_no', 'financial_name', 'financial_sales', 'financial_share_capital', 'financial_net_profit', 'financial_debtors', 'financial_creditors', 'financial_total_loans', 'financial_depriciation', 'bank_bank_name', 'bank_account_holder', 'bank_account_number', 'bank_pan_card_no', 'bank_current_balance'], 'string', 'max' => 150],
            [['alternate_contact_no', 'pan_first_name', 'pan_last_name', 'pan_middle_name', 'ac_first_name', 'ac_last_name', 'ac_middle_name', 'ac_aadhar_no', 'passport_first_name', 'passport_last_name', 'passport_middle_name', 'passport_passport_no', 'electricity_name', 'electricity_is_complete', 'voter_first_name', 'voter_last_name', 'voter_middle_name', 'shop_act_name', 'shop_act_shop_act_no'], 'string', 'max' => 50],
            [['case_id', 'branch', 'company_name', 'telephone_name', 'driving_name', 'company_id_name', 'company_id_designation', 'rent_agreement_met_name', 'rent_agreement_owner_name', 'sale_agreement_seller_name', 'sale_agreement_purchaser_name', 'oc_cc_plan_issuing_authority', 'oc_cc_plan_signature', 'ocr_receipt_builder_name', 'ocr_receipt_met_person', 'ocr_receipt_designation', 'ocr_receipt_signature', 'ocr_receipt_tpc'], 'string', 'max' => 100],
            [['address', 'pan_address', 'ac_address', 'passport_address', 'electricity_address', 'voter_address', 'shop_act_address', 'gst_name', 'gst_address'], 'string', 'max' => 500],
            [['bank_address', 'bank_narration'], 'string', 'max' => 1000],
            [['pan_pan_no'], 'string', 'max' => 15],
            [['driving_driving_license_number'], 'string', 'max' => 20],
            [['ocr_receipt_landmark'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
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
            'company_name' => 'Company Name',
            'address' => 'Address',
            'application_status' => 'Application Status',
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
            'pan_first_name' => 'Pan First Name',
            'pan_last_name' => 'Pan Last Name',
            'pan_middle_name' => 'Pan Middle Name',
            'pan_address' => 'Pan Address',
            'pan_pan_no' => 'Pan Pan No',
            'pan_dob' => 'Pan Dob',
            'pan_date_of_issue' => 'Pan Date Of Issue',
            'pan_is_complete' => 'Pan Is Complete',
            'pan_feedback' => 'Pan Feedback',
            'ac_first_name' => 'Ac First Name',
            'ac_last_name' => 'Ac Last Name',
            'ac_middle_name' => 'Ac Middle Name',
            'ac_aadhar_no' => 'Ac Aadhar No',
            'ac_dob' => 'Ac Dob',
            'ac_address' => 'Ac Address',
            'ac_mobile_no' => 'Ac Mobile No',
            'ac_is_complete' => 'Ac Is Complete',
            'ac_feedback' => 'Ac Feedback',
            'passport_first_name' => 'Passport First Name',
            'passport_last_name' => 'Passport Last Name',
            'passport_middle_name' => 'Passport Middle Name',
            'passport_passport_no' => 'Passport Passport No',
            'passport_address' => 'Passport Address',
            'passport_validity' => 'Passport Validity',
            'passport_date_of_issue' => 'Passport Date Of Issue',
            'passport_is_complete' => 'Passport Is Complete',
            'passport_feedback' => 'Passport Feedback',
            'electricity_name' => 'Electricity Name',
            'electricity_address' => 'Electricity Address',
            'electricity_is_complete' => 'Electricity Is Complete',
            'electricity_feedback' => 'Electricity Feedback',
            'telephone_mobile_no' => 'Telephone Mobile No',
            'telephone_amount' => 'Telephone Amount',
            'telephone_name' => 'Telephone Name',
            'telephone_address' => 'Telephone Address',
            'telephone_is_complete' => 'Telephone Is Complete',
            'telephone_feedback' => 'Telephone Feedback',
            'voter_first_name' => 'Voter First Name',
            'voter_last_name' => 'Voter Last Name',
            'voter_middle_name' => 'Voter Middle Name',
            'voter_address' => 'Voter Address',
            'voter_voter_id_no' => 'Voter Voter Id No',
            'voter_is_complete' => 'Voter Is Complete',
            'voter_feedback' => 'Voter Feedback',
            'driving_name' => 'Driving Name',
            'driving_driving_license_number' => 'Driving Driving License Number',
            'driving_validity' => 'Driving Validity',
            'driving_date_of_issue' => 'Driving Date Of Issue',
            'driving_is_complete' => 'Driving Is Complete',
            'driving_feedback' => 'Driving Feedback',
            'company_id_name' => 'Company Id Name',
            'company_id_designation' => 'Company Id Designation',
            'company_id_is_complete' => 'Company Id Is Complete',
            'company_id_feedback' => 'Company Id Feedback',
            'shop_act_name' => 'Shop Act Name',
            'shop_act_shop_act_no' => 'Shop Act Shop Act No',
            'shop_act_address' => 'Shop Act Address',
            'shop_act_from_date' => 'Shop Act From Date',
            'shop_act_till_date' => 'Shop Act Till Date',
            'shop_act_is_complete' => 'Shop Act Is Complete',
            'shop_act_feedback' => 'Shop Act Feedback',
            'gst_name' => 'Gst Name',
            'gst_gst_no' => 'Gst Gst No',
            'gst_address' => 'Gst Address',
            'gst_is_complete' => 'Gst Is Complete',
            'gst_feedback' => 'Gst Feedback',
            'rent_agreement_met_name' => 'Rent Agreement Met Name',
            'rent_agreement_owner_name' => 'Rent Agreement Owner Name',
            'rent_agreement_rent_amount' => 'Rent Agreement Rent Amount',
            'rent_agreement_deposit_amount' => 'Rent Agreement Deposit Amount',
            'rent_agreement_validity' => 'Rent Agreement Validity',
            'rent_agreement_is_complete' => 'Rent Agreement Is Complete',
            'rent_agreement_feedback' => 'Rent Agreement Feedback',
            'sale_agreement_seller_name' => 'Sale Agreement Seller Name',
            'sale_agreement_purchaser_name' => 'Sale Agreement Purchaser Name',
            'sale_agreement_address' => 'Sale Agreement Address',
            'sale_agreement_is_complete' => 'Sale Agreement Is Complete',
            'sale_agreement_feedback' => 'Sale Agreement Feedback',
            'oc_cc_plan_cts_no' => 'Oc Cc Plan Cts No',
            'oc_cc_plan_issuing_authority' => 'Oc Cc Plan Issuing Authority',
            'oc_cc_plan_signature' => 'Oc Cc Plan Signature',
            'oc_cc_plan_is_complete' => 'Oc Cc Plan Is Complete',
            'oc_cc_plan_feedback' => 'Oc Cc Plan Feedback',
            'ocr_receipt_builder_name' => 'Ocr Receipt Builder Name',
            'ocr_receipt_met_person' => 'Ocr Receipt Met Person',
            'ocr_receipt_designation' => 'Ocr Receipt Designation',
            'ocr_receipt_signature' => 'Ocr Receipt Signature',
            'ocr_receipt_tpc' => 'Ocr Receipt Tpc',
            'ocr_receipt_landmark' => 'Ocr Receipt Landmark',
            'ocr_receipt_amount' => 'Ocr Receipt Amount',
            'ocr_receipt_receipt_no' => 'Ocr Receipt Receipt No',
            'ocr_receipt_is_complete' => 'Ocr Receipt Is Complete',
            'ocr_receipt_feedback' => 'Ocr Receipt Feedback',
            'version' => 'Version',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
