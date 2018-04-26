<?php

namespace app\modules\api\modules\v1\models;

use Yii;
use app\modules\api\modules\v1\models\Api;
use app\modules\api\modules\v1\models\TblApiUsage;
use app\modules\api\modules\v1\models\TblOauthAccessTokens;
use app\modules\api\modules\v1\models\TblApiErrors;
use app\modules\applications\models\ApplicationsVerifiers;
use app\modules\applications\models\Applications;
use app\modules\applications\models\ApplicantPhotos;
use app\modules\applications\models\Noc;
use app\modules\applications\models\Kyc;
use app\modules\applications\models\ApplicationsVerifiersRevoked;
use app\models\Notifications;
use mdm\admin\models\UserDetails;

/**
 * 
 */
class Api extends \yii\db\ActiveRecord {
    /*
      @purpose = Get Input Data
      @author = hwk
     */
    
    const RESIDENCE_FIELDS = 'application_id, resi_society_name_plate, resi_door_name_plate, resi_tpc_neighbor_1, resi_tpc_neighbor_2, resi_met_person, resi_relation, resi_home_area, resi_ownership_status, resi_ownership_status_text, resi_stay_years, resi_total_family_members, resi_working_members, resi_locality, resi_locality_text, resi_landmark_1, resi_landmark_2, resi_structure, resi_market_feedback, resi_remarks, resi_status, resi_is_reachable, resi_not_reachable_remarks, resi_rented_owner_name, resi_rent_amount';
    const BUSINESS_FIELDS = 'application_id, busi_tpc_neighbor_1, busi_tpc_neighbor_2, busi_company_name_board, busi_met_person, busi_designation, busi_nature_of_business, busi_staff_declared, busi_staff_seen, busi_years_in_business, busi_type_of_business, busi_ownership_status, busi_ownership_status_text, busi_area, busi_locality, busi_locality_text, busi_landmark_1, busi_landmark_2, busi_structure, busi_remarks, busi_status, busi_is_reachable, busi_not_reachable_remarks, busi_activity_seen, busi_rented_owner_name, busi_rent_amount';
    const OFFICE_FIELDS = 'application_id, office_company_name_board, office_designation, office_met_person, office_met_person_designation, office_department, office_nature_of_company, office_employment_years, office_net_salary_amount, office_tpc_for_applicant, office_tpc_for_company, office_landmark, office_structure, office_remarks, office_status, office_is_reachable, office_not_reachable_remarks';
    const NOC_FIELDS = 'application_id, noc_structure, noc_status, noc_is_reachable, noc_not_reachable_remarks';
    const RESI_OFFICE_FIELDS = 'application_id, resi_office_society_name_plate, resi_office_door_name_plate, resi_office_tpc_neighbor_1, resi_office_tpc_neighbor_2, resi_office_met_person, resi_office_relation, resi_office_home_area, resi_office_ownership_status, resi_office_ownership_status_text, resi_office_stay_years, resi_office_total_family_members, resi_office_working_members, resi_office_company_name_board, resi_office_designation, resi_office_met_person, resi_office_met_person_designation, resi_office_department, resi_office_nature_of_company, resi_office_employment_years, resi_office_net_salary_amount, resi_office_tpc_for_applicant, resi_office_tpc_for_company, resi_office_locality, resi_office_locality_text, resi_office_landmark_1, resi_office_landmark_2, resi_office_structure, resi_office_market_feedback, resi_office_remarks, resi_office_status, resi_office_is_reachable, resi_office_not_reachable_remarks, resi_office_rented_owner_name, resi_office_rent_amount';
    const BUILDER_PROFILE_FIELDS = 'application_id, builder_profile_company_name_board, builder_profile_met_person, builder_profile_met_person_designation, builder_profile_exsistence, builder_profile_current_projects, builder_profile_previous_projects, builder_profile_staff, builder_profile_area, builder_profile_type_of_office, builder_profile_tpc_neighbor_1, builder_profile_tpc_neighbor_2, builder_profile_landmark_1, builder_profile_landmark_2, builder_profile_is_reachable, builder_profile_not_reachable_remarks';
    const PROPERTY_APF_FIELDS = 'application_id, property_apf_met_person, property_apf_met_person_designation, property_apf_property_status, property_apf_no_of_workers, property_apf_mode_of_payment, property_apf_construction_stock, property_apf_total_flats, property_apf_how_many_sold, property_apf_total_shops, property_apf_area, property_apf_work_completed, property_apf_possession, property_apf_apf, property_apf_delay_in_work, property_apf_tpc, property_apf_landmark, property_apf_is_reachable, property_apf_not_reachable_remarks';
    const INDIV_PROPERTY_FIELDS = 'application_id, indiv_property_met_person, indiv_property_met_person_designation, indiv_property_property_confirmed, indiv_property_previous_owner, indiv_property_property_type, indiv_property_area, indiv_property_approx_market_value, indiv_property_society_name_plate, indiv_property_door_name_plate, indiv_property_tpc, indiv_property_landmark, indiv_property_is_reachable, indiv_property_not_reachable_remarks';
    const NOC_SOC_FIELDS = 'application_id, noc_soc_address, noc_soc_address_verification, noc_soc_address_pincode, noc_soc_address_trigger, noc_soc_address_lat, noc_soc_address_long, noc_soc_met_person, noc_soc_met_person_designation, noc_soc_signature_done_by, noc_soc_bldg_reg_number, noc_soc_society_type, noc_soc_previous_owner, noc_soc_is_reachable, noc_soc_not_reachable_remarks, noc_soc_chairman_name, noc_soc_secretary_name, noc_soc_tresurer_name';
    const KYC_UPLOAD_DIR_NAME = "uploads/kyc/";
    const INSTITUTES_DIR_NAME = "images/instiutes/";

    public function get_input_data() {
        $inputs = '';
        $inputs = file_get_contents('php://input');
        $inputs = json_decode($inputs);

        if ($inputs == NULL) {
            return false;
        } else {
            return json_decode(json_encode($inputs), True);
        }
    }

    /*
      @purpose = This function is used to encode array to JSON
      @author = hwk
     */

    public function encode_to_json($arraytoencode) {
        $encodedarray = json_encode($arraytoencode);

        return $encodedarray;
    }

    /*
      @purpose = This function is used to generate random string
      @author = hwk
      @type = Internal
     */

    function random_string($length) {
        $rand = '';
        $salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $i = 0;
        while ($i < $length) { // Loop until you have met the length
            $num = rand() % strlen($salt);
            $tmp = substr($salt, $num, 1);
            $rand = $rand . $tmp;
            $i++;
        }
        return $rand; // Return the random string
    }

    /*
      @purpose = This function is used to save api usage
      @author = hwk
     */

    public function api_usage($access_token, $method_name, $user_ip, $api_data) {
        $apiUsage = new TblApiUsage();
        $apiUsage->access_token = $access_token;
        $apiUsage->method_name = $method_name;
        $apiUsage->sender_ip = $user_ip;
        $apiUsage->received_data = serialize($api_data);
        $apiUsage->request_date = date("Y-m-d H:i:s");

        $apiUsage->save();
        $apiUsage->refresh();
        $api_usage_id = $apiUsage->getPrimaryKey();

        return $api_usage_id;
    }

    /*
      @purpose = This function is used to generate token
      @author = hwk
     */

    function gen_token($mobile_unique_code, $user_id) {
        $access_token = new TblOauthAccessTokens();
        $token = Api::random_string(40);
        $token_expiry = date('Y-m-d H:i:s', strtotime('1 year'));
        $fullname = '';
        
        #user Data
        $user_details = UserDetails::find()->where(['user_id' => $user_id])->one();
        
        if(!empty($user_details)) {
            $fullname = $user_details->first_name.' '.$user_details->middle_name.' '.$user_details->last_name;
        }

        #check if token already present
        $token_details = TblOauthAccessTokens::find()->where(['mobile_unique_code' => $mobile_unique_code])->one();
        if (!empty($token_details)) {
            if (strtotime($token_details->expires) > strtotime(date('Y-m-d H:i:s'))) {
                $token = $token_details->access_token;
                $token_expiry = $token_details->expires;
            } else {
                $token_details->access_token = $token;
                $token_details->expires = $token_expiry;
                $token_details->update();
            }
        } else {

            $access_token->access_token = $token;
            $access_token->mobile_unique_code = $mobile_unique_code;
            $access_token->expires = $token_expiry;
            $access_token->user_id = $user_id;

            $access_token->save(false);
        }

        $return_array = array(
            "access_token" => $token,
            "expires_in" => floor((strtotime($token_expiry) - strtotime(date('Y-m-d H:i:s'))) / (60 * 60 * 24)),
            "fullname" => $fullname
        );

        return $return_array;
    }

    /*
      @purpose = This function is used to generate response for api request
      @author = hwk
     */

    function api_response($api_usage_id, $response_type, $response_message, $response_data, $error_code = NULL) {
        $issuccess = true;

        $error_array = array();

        if ($response_type === 2) {
            $issuccess = false;
        }

        $res_array = array(
            'issuccess' => $issuccess,
            'data' => $response_data,
            'message' => $response_message
        );

        if (!empty($error_code)) {
            if (is_array($error_code)) {
                $count = 0;
                foreach ($error_code as $error) {
                    $error_data = TblApiErrors::find()->where(['code' => $error])->one();
                    $error_msg = $error_data->message;

                    $error_array[$count][$error] = $error_msg;
                    $count++;
                }
                $res_array['error'] = $error_array;
            } else {

                $error_data = TblApiErrors::find()->where(['code' => $error_code])->one();
                $error_msg = $error_data->message;
                $res_array['error'] = array($error_code => $error_msg);
            }
        }

        $res_json = Api::encode_to_json($res_array);

        $TblApiUsage = TblApiUsage::findOne(["id" => $api_usage_id]);
        if(!empty($TblApiUsage)) {
            $TblApiUsage->response_data = serialize($res_json);
            $TblApiUsage->response_date = date("Y-m-d H:i:s");

            $TblApiUsage->save(false);
        }

        //return JSON
        return $res_json;
    }

    /*
      @purpose = This function is used to verfy token
      @author = hwk
      @type = Internal
     */

    function verify_token($token) {
        $response_data = array();
        #check if token already present
        $token_details = TblOauthAccessTokens::find()->where(['access_token' => $token])->one();
        if (!empty($token_details)) {
            if (strtotime($token_details->expires) > strtotime(date('Y-m-d H:i:s'))) {
                $issuccess = true;
                $response_message = 'The access token provided is valid';
                $response_data['user_id'] = $token_details->user_id;
            } else {
                $issuccess = false;
                $response_message = 'The access token provided has expired';
            }
        } else {
            $issuccess = false;
            $response_message = 'The access token provided is invalid';
        }

        $res_array = array(
            'issuccess' => $issuccess,
            'message' => $response_message,
            'data' => $response_data
        );
        return $res_array;
    }

    function process_api_request($api_name, $ip_address) {
        $received_data = Api::get_input_data();
        $data = new \stdClass();
        $data->api_usage_id = '';
        $data->received_data = NULL;
        $r_data = '';
        if ($received_data != false) {
            //Check if Token id correct
            $received_access_token = self::verify_token($received_data['access_token']);
            if ($received_access_token['issuccess'] === true) {
                if (!empty($received_data['data'])) {
                    $r_data = $received_data['data'];
                }
                #Register API usage
                $data->api_usage_id = self::api_usage($received_data['access_token'], $api_name, $ip_address, $r_data);
                $data->received_data = $received_data['data'];
                $data->user_id = $received_access_token['data']['user_id'];
            } else {
                $data->response = Api::api_response($data->api_usage_id, 2, '', '', '1004');
            }
        } else {
            $data->response = Api::api_response($data->api_usage_id, 2, '', '', '1000');
        }
        return $data;
    }
    
    function get_all_sites($user_id) {        
        $connection = Yii::$app->getDb();
        $all_sites = $connection->createCommand("SELECT * FROM view_all_sites WHERE mobile_user_id = {$user_id}")->queryAll();        
        $return_array = array();        
        $new = 0;
        $inprogress = 0;
        $completed = 0;        
        if(!empty($all_sites)) {
            foreach($all_sites as $site) {
                $temp_array = array();
                $temp_array['app_id'] = $site['app_id'];
                $temp_array['verification_id'] = $site['verification_id'];
                $temp_array['application_id'] = $site['application_id'];
                $temp_array['applicant_name'] = $site['applicant_name'];
                $temp_array['loan_type'] = $site['loan_type'];
                $temp_array['verification_address'] = $site['verification_address'].self::getContactNo($site['mobile_no'], $site['alternate_contact_no']);
                $temp_array['verification_triggers'] = $site['verification_triggers'];
                $temp_array['date_of_application'] = $site['date_of_application'];
                $temp_array['verification_type_id'] = $site['verification_type_id'];
                $temp_array['verification_type'] = $site['verification_type'];
                $temp_array['mobile_user_assigned_date'] = $site['mobile_user_assigned_date'];
                $temp_array['mobile_user_status'] = $site['mobile_user_status'];
                $temp_array['mobile_user_status_updated_on'] = $site['mobile_user_status_updated_on'];                
                $temp_array['institute_name'] = $site['institute_name'];                
                $temp_array['latitude'] = $site['latitude'];                
                $temp_array['longitude'] = $site['longitude'];   
                $temp_array['thumb_link'] = Yii::$app->request->BaseUrl . '/' . self::INSTITUTES_DIR_NAME . 'thumbs/' . $site['file_name'];
                $temp_array['img_link'] = Yii::$app->request->BaseUrl . '/' . self::INSTITUTES_DIR_NAME . $site['file_name'];
                $status = ($site['mobile_user_status'] == 0) ? 'new' : (($site['mobile_user_status'] == 1) ? 'inprogress' : 'completed');
                ($site['mobile_user_status'] == 0) ? $new++ : (($site['mobile_user_status'] == 1) ? $inprogress++ : $completed++);                
                $return_array['sites'][$status][] = $temp_array;
            }
            $return_array['count']['new'] = $new;
            $return_array['count']['inprogress'] = $inprogress;
            $return_array['count']['completed'] = $completed;
            $return_array['count']['total'] = $new+$inprogress+$completed;
            return $return_array;
        }
        return false;
    }
    
    function get_site_details($app_id, $verification_type, $user_id) {
        $return_array = array();  
        $docs_array = array(1,2);
        $photos_array = array(1,2,3,4,5,6,7,8,9);
        $noc_array = array(4);
        $verification_details = ApplicationsVerifiers::find()->where(['application_id' => $app_id, 'verification_type' => $verification_type, 'mobile_user_id' => $user_id])->one();
        if(!empty($verification_details)) {
            #verification details
            $select_fields = self::getSelectionFields($verification_type);
            $application_details = Applications::find()
                        ->select("{$select_fields}")
                        ->where(['id' => $app_id])->asArray()->one();
            $return_array['verification_details'] = $application_details;
            #doc details
            if(in_array($verification_type, $docs_array)) {
                $docs_details = self::get_docs_photos($app_id, $application_details['application_id'], 2, $verification_type);
                if(!empty($docs_details)) {
                    $return_array['doc_details'] = $docs_details;
                }
            }
            #photo details
            if(in_array($verification_type, $photos_array)) {
                $photos_details = self::get_docs_photos($app_id, $application_details['application_id'], 1, $verification_type);
                if(!empty($photos_details)) {
                    $return_array['photo_details'] = $photos_details;
                }
            }   
            #noc details
            if(in_array($verification_type, $noc_array)) {
                $noc_details = self::get_noc_details($app_id);
                if(!empty($noc_details)) {
                    $return_array['noc_details'] = $noc_details;
                }
            }
            #site info
            $site_info = self::get_site_info($app_id, $verification_type);
            if(!empty($site_info)) {
                $return_array['site_info'] = $site_info;
            }
            
            #kyc details
            $kyc_details = self::get_kyc_details($app_id, $application_details['application_id']);
            if(!empty($kyc_details)) {
                $return_array['kyc_details'] = $kyc_details;
            }
            
            return $return_array;
        }
        return false;
    }
    
    function getContactNo($mobile_no, $alternate_contact_no) {
        $return = '';
        if(!empty($mobile_no)) {
            $return .= ', '.PHP_EOL.'Contact No : '. $mobile_no;
        }
        if(!empty($alternate_contact_no)) {
            if(empty($return)) {
                $return .= ', '.PHP_EOL.'Contact No : '.$alternate_contact_no;
            } else {
                $return .= ' / '.$alternate_contact_no;
            }
        }        
        return $return;
    }
    
    function getSelectionFields($verification_type) {
        $select_fields = '';
        if(!empty($verification_type)) {
            switch ($verification_type) {
                case 1:
                    $select_fields = Api::RESIDENCE_FIELDS;
                    break;
                case 2:
                    $select_fields = Api::BUSINESS_FIELDS;
                    break;
                case 3:
                    $select_fields = Api::OFFICE_FIELDS;
                    break;
                case 4:
                    $select_fields = Api::NOC_FIELDS;
                    break;
                case 5:
                    $select_fields = Api::RESI_OFFICE_FIELDS;
                    break;
                case 6:
                    $select_fields = Api::BUILDER_PROFILE_FIELDS;
                    break;
                case 7:
                    $select_fields = Api::PROPERTY_APF_FIELDS;
                    break;
                case 8:
                    $select_fields = Api::INDIV_PROPERTY_FIELDS;
                    break;
                case 9:
                    $select_fields = Api::NOC_SOC_FIELDS;
                    break;
                default:
                    $select_fields = Api::RESIDENCE_FIELDS;
            }
        }
        return $select_fields;
    }
    
    function getVerificationType($verification_type) {
        $verification_type_text = '';
        if(!empty($verification_type)) {
            switch ($verification_type) {
                case 1:
                    $verification_type_text = 'Residence';
                    break;
                case 2:
                    $verification_type_text = 'Business';
                    break;
                case 3:
                    $verification_type_text = 'Office';
                    break;
                case 4:
                    $verification_type_text = 'NOC (Business/Conditional)';
                    break;
                case 5:
                    $verification_type_text = 'Residence/Office';
                    break;
                case 6:
                    $verification_type_text = 'Builder Profile';
                    break;
                case 7:
                    $verification_type_text = 'Property (APF)';
                    break;
                case 8:
                    $verification_type_text = 'Individual Property';
                    break;
                case 9:
                    $verification_type_text = 'NOC (Society)';
                    break;
                default:
                    $verification_type_text = 'Residence';
            }
        }
        return $verification_type_text;
    }
    
    function get_docs_photos($id, $application_id, $type, $section) {
        $return_array = array();
        
        $photos = ApplicantPhotos::find()->where(['application_id' => $id, 'section' => $section, 'type' => $type, 'is_deleted' => '0'])->all();
        if (!empty($photos)) {
            foreach ($photos as $photos_data) {
                $temp_array = array ();
                $temp_array['id'] = $photos_data['id'];
                $temp_array['thumb_link'] = Yii::$app->request->BaseUrl . '/' . self::KYC_UPLOAD_DIR_NAME . $application_id . '/thumbs/' . $photos_data['file_name'];
                $temp_array['img_link'] = Yii::$app->request->BaseUrl . '/' . self::KYC_UPLOAD_DIR_NAME . $application_id . '/' . $photos_data['file_name'];
                $temp_array['remarks'] = $photos_data['remarks'];
                $temp_array['verification_type'] = $section;
                $temp_array['type'] = $type;                
                $return_array[] = $temp_array;
            }
        }
        return $return_array;
    }
    
    function get_noc_details($id) {
        $return_array = array();
        
        $noc_details = Noc::find()->where(['application_id' => $id, 'is_deleted' => '0'])->all();
        if (!empty($noc_details)) {
            foreach ($noc_details as $noc_details_data) {
                $temp_array = array ();
                $temp_array['id'] = $noc_details_data['id'];
                $temp_array['met_person'] = $noc_details_data['met_person'];
                $temp_array['designation'] = $noc_details_data['designation'];
                $temp_array['remarks'] = $noc_details_data['remarks'];
                $return_array[] = $temp_array;
            }
        }
        return $return_array;
    }
    
    function update_site_status($verification_id, $verification_status, $user_id) {
        $verification_details = ApplicationsVerifiers::find()->where(['id' => $verification_id, 'mobile_user_id' => $user_id])->one();
        if(!empty($verification_details)) {
            if($verification_status == 3) {
                #site revoked by verifier
                #remove record from primary table & insert record in revoked table
                $revoke_model = new ApplicationsVerifiersRevoked();
                
                $revoke_model->application_id = $verification_details->application_id;
                $revoke_model->verification_type = $verification_details->verification_type;
                $revoke_model->mobile_user_id = $verification_details->mobile_user_id;
                $revoke_model->mobile_user_assigned_date = $verification_details->mobile_user_assigned_date;
                $revoke_model->mobile_user_status = $verification_details->mobile_user_status;
                $revoke_model->mobile_user_status_updated_on = $verification_details->mobile_user_status_updated_on;
                $revoke_model->old_created_on = $verification_details->created_on;
                
                if ($revoke_model->save()) {
                    #remove record from primary table
                    $verifiers_data = ApplicationsVerifiers::findOne($verification_details->id)->delete();
                }
            } else {
                $application_id = $verification_details->application_id;
                #update verification status
                $verification_details->mobile_user_status = $verification_status;
                $verification_details->mobile_user_status_updated_on = date('Y-m-d H:i:s');
                $verification_details->save(false);
                #update application status
                self::update_application_status($application_id);
            }
            
            self::addNotification($verification_status, $verification_details);
            
            return true;
        }
        return false;
    }
    
    function update_application_status($application_id) {
        $total = 0;
        $count_inprogress = 0;
        $count_completed = 0;
        
        $verification_details = ApplicationsVerifiers::find()->where(['application_id' => $application_id])->all();
        if(!empty($verification_details)) {
            foreach ($verification_details as $verification_detail) {
                if($verification_detail['mobile_user_status'] == 1){
                    $count_inprogress++;
                }
                if($verification_detail['mobile_user_status'] == 2){
                    $count_completed++;
                }
                $total++;
            }
            $application_details = Applications::find()->where(['id' => $application_id])->one();            
            #For Inprogress
            if($count_inprogress == 1 && $total > 0) {
                $application_details->application_status = 2;
                $application_details->save(false);
            }
            #For Completed
            if($count_completed == $total && $total > 0) {
                $application_details->application_status = 3;
                $application_details->save(false);
            }
        }
    }
    
    function update_site_details($received_data, $user_id) {    
        $return_array = array();
        $model = Applications::find()
                ->where(['id' => $received_data['id']])
                ->one();
        
        foreach ($received_data as $key => $value) {
            $model->$key = $value;
        }
        if ($model->save()) {
            $return_array['status'] = 'success';
            $return_array['msg'] = '';
        } else {
            $errors = self::process_model_errors($model->getErrors());
            $return_array['status'] = 'failure';
            $return_array['msg'] = $errors;            
        }
        return $return_array;
    }
    
    function process_model_errors($errors) {
        $return_data = '';
        foreach($errors as $key => $value) {
            $return_data .= $key." : ";
            foreach($value as $text) {
                $return_data .= $text;
            }
            $return_data .= ",";
        }
        if(!empty($return_data)) {
            $return_data = substr($return_data, 0, -1);
        }
        return $return_data;
    }
    
    function upload_photos ($received_data, $user_id) {   
        $return_array = array();
        $model = Applications::find()
                ->where(['id' => $received_data['app_id']])
                ->one();
        
        $file_name = $received_data['photos_file_name'];
                
        $file_name_exploded = explode('.', $file_name);
        $file_ext = strtolower(end($file_name_exploded));

        $expensions = array("jpeg", "jpg", "png");
        
        $newfile_name = date('dmYHis') . $file_name;
        
        $dirname = self::KYC_UPLOAD_DIR_NAME . $model->application_id;
        if (!file_exists($dirname)) {
            mkdir($dirname);
            mkdir($dirname . '/thumbs');
        }

        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if (empty($errors) == true) {
            $img = $received_data['photos_file'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $file = $dirname . '/' . $newfile_name;
            $success = file_put_contents($file, $data);
            
            $upload_img = Applications::thumbnailCreator($newfile_name, $dirname, 'thumbs', '200', '160', '', $file_ext);
            
            #Add data to kyc
            $ap_model = new ApplicantPhotos();

            $ap_model->application_id = $received_data['app_id'];
            $ap_model->remarks = $received_data['photos_remark'];
            $ap_model->file_name = $newfile_name;
            $ap_model->section = $received_data['photos_section'];
            $ap_model->type = $received_data['photos_type'];
            $ap_model->latitude = $received_data['photos_latitude'];
            $ap_model->longitude = $received_data['photos_longitude'];
            $ap_model->created_by = $user_id;

            $ap_model->save(FALSE);
            
            $return_array['status'] = 'success';
            $return_array['msg'] = '';  
        } else {
            $return_array['status'] = 'failure';
            $return_array['msg'] = $errors;  
        }
        return $return_array;
    }
    
    function add_noc_met_person($noc_data, $user_id) {    
        $return_array = array();
        
        $model = new Noc();

        $model->application_id = $noc_data['app_id'];
        $model->met_person = isset($noc_data['met_person']) ? $noc_data['met_person'] : '';
        $model->designation = isset($noc_data['designation']) ? $noc_data['designation'] : '';
        $model->remarks = isset($noc_data['remarks']) ? $noc_data['remarks'] : '';
        $model->created_by = $user_id;
        $model->save();
        
        if ($model->save()) {
            $return_array['status'] = 'success';
            $return_array['msg'] = '';
        } else {
            $errors = self::process_model_errors($model->getErrors());
            $return_array['status'] = 'failure';
            $return_array['msg'] = $errors;            
        }
        return $return_array;
    }
    
    function delete_photos_noc($received_data, $user_id) {
        $return_array = array();
        $id = $received_data['id'];
        $type = $received_data['type'];
        
        if($type == 1 || $type == 2) {
            if($type == 1) {
                $model = ApplicantPhotos::find()
                ->where(['id' => $id])
                ->one();
            } else if($type == 2) {
                $model = Noc::find()
                ->where(['id' => $id])
                ->one();
            }
            $model->is_deleted = 1;
            $model->updated_by = $user_id;
            
            if ($model->save()) {
            $return_array['status'] = 'success';
            $return_array['msg'] = '';
            } else {
                $errors = self::process_model_errors($model->getErrors());
                $return_array['status'] = 'failure';
                $return_array['msg'] = $errors;            
            }
            
        } else {
            $return_array['status'] = 'failure';
            $return_array['msg'] = 'Invalid Input';            
        }
        return $return_array;
    }
    
    public function get_kyc_details($id, $application_id) {
        $return_array = array();
        $photos = Kyc::find()->where(['application_id' => $id, 'is_deleted' => '0', 'send_for_verification' => '1'])->all();
        if (!empty($photos)) {
            foreach ($photos as $photos_data) {
                $temp_array = array ();
                $temp_array['id'] = $photos_data['id'];
                $temp_array['thumb_link'] = Yii::$app->request->BaseUrl . '/' . self::KYC_UPLOAD_DIR_NAME . $application_id . '/thumbs/' . $photos_data['file_name'];
                $temp_array['img_link'] = Yii::$app->request->BaseUrl . '/' . self::KYC_UPLOAD_DIR_NAME . $application_id . '/' . $photos_data['file_name'];
                $temp_array['doc_type'] = $photos_data['doc_type'];
                $temp_array['remarks'] = $photos_data['remarks'];
                $return_array[] = $temp_array;
            }
        }
        return $return_array;
    }
    
    public function get_site_info($id, $verification_type) {
        $return_array = array();
        $connection = Yii::$app->getDb();
        $site_details = $connection->createCommand("SELECT * FROM view_all_sites WHERE app_id = {$id} AND verification_type_id = {$verification_type}")->queryOne();
        if(!empty($site_details)) {
            $return_array['applicant_name'] = $site_details['applicant_name'];
            $return_array['verification_address'] = $site_details['verification_address'].self::getContactNo($site_details['mobile_no'], $site_details['alternate_contact_no']);
            $return_array['institute_name'] = $site_details['institute_name'];  
            $return_array['loan_type'] = $site_details['loan_type'];
        }
        return $return_array;
    }
    
    public function addNotification($verification_status, $verification_details) {
        $notification_model = new Notifications();
        $application_id = $verification_details->application_id;
        $application_details = Applications::find()->where(['id' => $application_id])->one();     
        $message = '';
        switch ($verification_status) {
            case 1:
                $message = 'Verification Started for '.$application_details->application_id.', address type : '.self::getVerificationType($verification_details->verification_type);
                break;
            case 2:
                $message = 'Verification Completed for '.$application_details->application_id.', address type : '.self::getVerificationType($verification_details->verification_type);
                break;
            case 3:
                $message = 'Site Revoked for '.$application_details->application_id.', address type : '.self::getVerificationType($verification_details->verification_type);
                break;
        }
        $notification_model->user_id = $application_details->created_by;
        $notification_model->message = $message;
        $notification_model->is_unread = 1;
        $notification_model->application_id = $application_id;
        $notification_model->notification_created_at = date("Y-m-d H:i:s");
        $notification_model->created_by = $verification_details->mobile_user_id;
        $notification_model->save(false);
    }
}
