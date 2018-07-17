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
 * @property integer $application_status
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $is_deleted
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
            [['profile_id', 'institute_id', 'loan_type_id', 'applicant_type', 'profile_type', 'area_id', 'application_status', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['date_of_application', 'financial_date_of_filing', 'bank_dated_transaction', 'bank_account_opening_date', 'bank_date_of_birth', 'created_on', 'updated_on', 'application_id', 'pan_first_name', 'pan_last_name', 'pan_middle_name', 'pan_address', 'pan_pan_no', 'pan_dob',
            'pan_date_of_issue', 'pan_is_complete', 'ac_first_name', 'ac_last_name', 'ac_middle_name', 'ac_aadhar_no', 'ac_dob', 'ac_address', 'ac_mobile_no', 'ac_is_complete', 'passport_first_name', 'passport_last_name', 'passport_middle_name', 'passport_passport_no', 'passport_passport_no',
            'passport_address', 'passport_validity', 'passport_date_of_issue', 'passport_is_complete', 'electricity_name', 'electricity_address', 'electricity_is_complete', 'telephone_is_complete', 'telephone_mobile_no', 'telephone_amount', 'telephone_name', 'telephone_address',
            'voter_first_name', 'voter_last_name', 'voter_middle_name', 'voter_address', 'voter_voter_id_no', 'voter_is_complete', 'driving_is_complete', 'driving_name', 'driving_driving_license_number', 'driving_validity', 'driving_date_of_issue', 'company_name', 'company_designation',
            'shop_act_is_complete', 'shop_act_name', 'shop_act_shop_act_no', 'shop_act_address', 'shop_act_from_date', 'shop_act_till_date', 'gst_name', 'gst_is_complete', 'gst_gst_no', 'gst_address', 'rent_agreement_met_name', 'rent_agreement_owner_name', 'rent_agreement_rent_amount',
            'rent_agreement_deposit_amount', 'rent_agreement_is_complete', 'rent_agreement_validity', 'sale_agreement_is_complete', 'sale_agreement_seller_name', 'sale_agreement_purchaser_name', 'sale_agreement_address', 'oc_cc_plan_cts_no', 'oc_cc_plan_is_complete', 'oc_cc_plan_issuing_authority',
            'oc_cc_plan_signature', 'ocr_receipt_builder_name', 'ocr_receipt_met_person', 'ocr_receipt_designation', 'ocr_receipt_signature', 'ocr_receipt_tpc', 'ocr_receipt_landmark', 'ocr_receipt_amount', 'ocr_receipt_receipt_no', 'ocr_receipt_is_complete'], 'safe'],
            [['first_name', 'middle_name', 'last_name', 'financial_pan_card_no', 'financial_name', 'financial_sales', 'financial_share_capital', 'financial_net_profit', 'financial_debtors', 'financial_creditors', 'financial_total_loans', 'financial_depriciation', 'bank_bank_name',
            'bank_account_holder', 'bank_account_number', 'bank_pan_card_no', 'bank_current_balance', 'financial_assessment_year'], 'string', 'max' => 150],
            [['bank_address', 'bank_narration'], 'string', 'max' => 1000],
            ['aadhaar_card_no', 'match', 'pattern' => '/^[0-9-]+$/', 'skipOnError' => true],
            ['aadhaar_card_no', 'validateAAdharCard'],
            ['pan_card_no', 'validatePanCard'],
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
            'application_status' => 'Application Status',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
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
            'sale_agreement_seller_name' => "Name",
            'sale_agreement_purchaser_name' => "Purchaser Name",
            'sale_agreement_address' => "Address",
            'rent_agreement_met_name' => "Met Name",
            'rent_agreement_owner_name' => "Owner Name",
            'rent_agreement_rent_amount' => "Rent Amount",
            'rent_agreement_validity' => "Validity",
            'rent_agreement_deposit_amount' => "Deposit Amount",
            'gst_name' => "Name",
            'gst_gst_no' => "GST No",
            'gst_address' => "Address",
            'shop_act_name' => "Name",
            'shop_act_shop_act_no' => "Shop Act No",
            'shop_act_address' => "Address",
            'shop_act_from_date' => "From Date",
            'shop_act_till_date' => "Till Date",
            'company_id_name' => "Name",
            'company_id_designation' => "Designation",
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

        $verifiers_data = ApplicationsVerifiers::find()->where(['application_id' => $id, 'is_deleted' => '0'])->all();

        $count = 0;
        if (!empty($verifiers_data)) {
            foreach ($verifiers_data as $verifier_data) {
                $count++;
            }
        }

        if ($application_status == 1 || $application_status == 2) {
            $assignable_count = 0;
            $applicationResi = ApplicationsResi::findOne(['application_id' => $id]);
            $applicationBusi = ApplicationsBusi::findOne(['application_id' => $id]);
            $applicationOffice = ApplicationsOffice::findOne(['application_id' => $id]);
            $applicationResiOffice = ApplicationsResiOffice::findOne(['application_id' => $id]);
            $applicationNocBusi = ApplicationsNocBusi::findOne(['application_id' => $id]);
            $applicationBuilderProfile = ApplicationsBuilderProfile::findOne(['application_id' => $id]);
            $applicationPropertyApf = ApplicationsPropertyApf::findOne(['application_id' => $id]);
            $applicationIndivProperty = ApplicationsIndivProperty::findOne(['application_id' => $id]);
            $applicationNocSoc = ApplicationsNocSoc::findOne(['application_id' => $id]);
            if (empty($applicationResi))
                $applicationResi = new ApplicationsResi();
            if (empty($applicationBusi))
                $applicationBusi = new ApplicationsBusi();
            if (empty($applicationOffice))
                $applicationOffice = new ApplicationsOffice();
            if (empty($applicationResiOffice))
                $applicationResiOffice = new ApplicationsResiOffice();
            if (empty($applicationNocBusi))
                $applicationNocBusi = new ApplicationsNocBusi();
            if (empty($applicationBuilderProfile))
                $applicationBuilderProfile = new ApplicationsBuilderProfile();
            if (empty($applicationBuilderProfile))
                $applicationBuilderProfile = new ApplicationsBuilderProfile();
            if (empty($applicationPropertyApf))
                $applicationPropertyApf = new ApplicationsPropertyApf();
            if (empty($applicationIndivProperty))
                $applicationIndivProperty = new ApplicationsIndivProperty();
            if (empty($applicationNocSoc))
                $applicationNocSoc = new ApplicationsNocSoc();

            if ($applicationResi->resi_address_verification == 1 ||
                    $applicationBusi->busi_address_verification == 1 ||
                    $applicationOffice->office_address_verification == 1 ||
                    $applicationNocBusi->noc_address_verification == 1 ||
                    $applicationResiOffice->resi_office_address_verification == 1 ||
                    $applicationBuilderProfile->builder_profile_address_verification == 1 ||
                    $applicationPropertyApf->property_apf_address_verification == 1 ||
                    $applicationIndivProperty->indiv_property_address_verification == 1 ||
                    $applicationNocSoc->noc_soc_address_verification == 1
            ) {
                if ($applicationResi->resi_address_verification == 1) {
                    $assignable_count++;
                }
                if ($applicationBusi->busi_address_verification == 1) {
                    $assignable_count++;
                }
                if ($applicationOffice->office_address_verification == 1) {
                    $assignable_count++;
                }
                if ($applicationNocBusi->noc_address_verification == 1) {
                    $assignable_count++;
                }
                if ($applicationResiOffice->resi_office_address_verification == 1) {
                    $assignable_count++;
                }
                if ($applicationBuilderProfile->builder_profile_address_verification == 1) {
                    $assignable_count++;
                }
                if ($applicationPropertyApf->property_apf_address_verification == 1) {
                    $assignable_count++;
                }
                if ($applicationIndivProperty->indiv_property_address_verification == 1) {
                    $assignable_count++;
                }
                if ($applicationNocSoc->noc_soc_address_verification == 1) {
                    $assignable_count++;
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
            $return = '<div><span style="color:#00a65a;font-weight:bold">Assigned : ' . $count . '</span></div><div style="clear:both;"><button type="button" class="btn btn-block btn-info btn-sm viewVerifier" value="' . $id . '">View Verifiers</button></div>';
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

    public function getAvailableStatus($available_status) {
        $return = '';

        switch ($available_status) {
            case 1:
                $return = 'Available for Verification';
                break;
            case 2:
                $return = 'Door Locked';
                break;
            case 3:
                $return = 'Shifted';
                break;
            case 4:
                $return = 'Door Locked & Shifted';
                break;
        }

        return $return;
    }

    public function getDedupCheckButton() {
        
    }

    public function getBadge($status) {
        if ($status == 0) {
            return '<span class="badge" style="background: #ff6c60 !important;">NOT-VERIFIED</span>';
        } else {
            return '<span class="badge" style="background: #a9d86e !important;">VERIFIED</span>';
        }
    }
}
