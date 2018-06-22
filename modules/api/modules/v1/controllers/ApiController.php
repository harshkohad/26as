<?php

namespace app\modules\api\modules\v1\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use mdm\admin\models\User;
use app\modules\api\modules\v1\models\Api;
use app\modules\manage_mobile_app\models\TblMobileUsers;
use app\modules\api\modules\v1\models\TblOauthIdentity;
use app\modules\applications\models\ApplicationsResi;
use app\modules\applications\models\ApplicationsBusi;
use app\modules\applications\models\ApplicationsOffice;
use app\modules\applications\models\ApplicationsNocBusi;
use app\modules\applications\models\ApplicationsResiOffice;
use app\modules\applications\models\ApplicationsBuilderProfile;
use app\modules\applications\models\ApplicationsPropertyApf;
use app\modules\applications\models\ApplicationsIndivProperty;
use app\modules\applications\models\ApplicationsNocSoc;


/**
 * A UserController Class.
 * User activities from version one can be controlled here.
 *
 * @author Harshwardhan Kohad <harsh.kohad@gmail.com>
 * @created_on : 29 Sept, 2017
 * @package 

 */
class ApiController extends Controller {

    const KYC_UPLOAD_DIR_NAME = "uploads/kyc/";
    
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'app-login' => ['post'],
                    'get-access-token' => ['post'],
                    'get-all-sites' => ['post'],
                    'get-site-details' => ['post'],
                    'update-site-status' => ['post'],
                    'update-site-details' => ['post'],
                    'upload-photos' => ['post'],
                    'add-noc-met-person' => ['post'],
                    'upload-photos-new' => ['post'],
                    'delete-photos-noc' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($event) {
        $action = $event->id;
        if (isset($this->actions[$action])) {
            $verbs = $this->actions[$action];
        } elseif (isset($this->actions['*'])) {
            $verbs = $this->actions['*'];
        } else {
            return $event->isValid;
        }
        $verb = Yii::$app->getRequest()->getMethod();
        $allowed = array_map('strtoupper', $verbs);
        if (!in_array($verb, $allowed)) {
            $this->getHeader(400);
            echo json_encode(['status' => 0, 'error_code' => 400, 'message' => 'Method not allowed'], JSON_PRETTY_PRINT);
            exit;
        }
        return true;
    }

    private function getHeader($status) {
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->getStatusCodeMessage($status);
        $content_type = "application/json; charset=utf-8";
        header($status_header);
        header('Content-type: ' . $content_type);
        header('SecretKey: ' . "xxxxx");
    }

    private function getStatusCodeMessage($status) {
        $codes = [
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        ];
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

    public function actionIndex() {
        $this->layout = '//main-login';
        return $this->render('api');
    }

    public function actionAppLogin() {
        $received_data = Api::get_input_data();

        $response = '';
        $api_usage_id = '';

        $api_name = 'AppLogin';

        $ip_address = Yii::$app->getRequest()->getUserIP();

        if ($received_data != false) {
            if (isset($received_data['data'][0])) {
                $received_data_data = isset($received_data['data'][0]) ? $received_data['data'][0] : "";
                #Check if username and password is valid or not
                $username = $received_data_data['username'];
                $password = $received_data_data['password'];
                $mobile_unique_code = $received_data_data['mobile_unique_code'];

                $user_details = User::find()->where(['username' => $username])->one();

                if (!empty($user_details)) {
                    #Register API usage
                    $api_usage_id = Api::api_usage($received_data['access_token'], $api_name, $ip_address, $received_data['data']);

                    $mobile_details = TblMobileUsers::find()->where(['user_id' => $user_details->id, 'mobile_unique_code' => $mobile_unique_code])->one();

                    if (!empty($mobile_details)) {
                        if (Yii::$app->getSecurity()->validatePassword($password, $user_details->password_hash)) {
                            $mobile_user_details = TblMobileUsers::find()->where(['user_id' => $user_details->id])->one();

                            #Generate token and save it into db
                            $return_array = Api::gen_token($mobile_user_details->mobile_unique_code, $user_details->id);

                            $response = Api::api_response($api_usage_id, 1, 'Login Successful.', $return_array);
                        } else {
                            $response = Api::api_response($api_usage_id, 2, '', '', '1002');
                        }
                    } else {
                        $response = Api::api_response($api_usage_id, 2, '', '', '1003');
                    }
                } else {
                    $response = Api::api_response($api_usage_id, 2, '', '', '1001');
                }
            }
        } else {
            $response = Api::api_response($api_usage_id, 2, '', '', '1000');
        }

        return $response;
    }

    public function actionGetAccessToken() {

        $received_data = Api::get_input_data();

        $response = '';
        $api_usage_id = '';

        $api_name = 'GetAccessToken';

        $ip_address = Yii::$app->getRequest()->getUserIP();

        if ($received_data != false) {

            if (isset($received_data['data'][0])) {
                $received_data_data = isset($received_data['data'][0]) ? $received_data['data'][0] : "";
                #Check if mobile unique code is valid or not
                $mobile_unique_code = $received_data_data['mobile_unique_code'];

                $mobile_details = TblMobileUsers::find()->where(['mobile_unique_code' => $mobile_unique_code])->one();

                if (!empty($mobile_details)) {
                    #Register API usage
                    $api_usage_id = Api::api_usage($received_data['access_token'], $api_name, $ip_address, $received_data['data']);

                    #Generate token and save it into db
                    $return_array = Api::gen_token($mobile_unique_code, $mobile_details->user_id);

                    $response = Api::api_response($api_usage_id, 1, 'API Access Token.', $return_array);
                }
            }
        } else {
            $response = Api::api_response($api_usage_id, 2, '', '', '1000');
        }

        return $response;
    }

    public function actionGetAllSites() {
        $response = Api::process_api_request('GetAllSites', Yii::$app->getRequest()->getUserIP());

        if (!empty($response->api_usage_id)) {
            #process data
            $return_array = Api::get_all_sites($response->user_id);
            if (!empty($return_array)) {
                return Api::api_response($response->api_usage_id, 1, 'All Sites', $return_array);
            } else {
                return Api::api_response($response->api_usage_id, 2, '', '', '1005');
            }
        } else {
            return $response->response;
        }
    }

    public function actionGetSiteDetails() {
        $response = Api::process_api_request('GetSiteDetails', Yii::$app->getRequest()->getUserIP());
        if (!empty($response->api_usage_id)) {
            $received_data = $response->received_data;
            $app_id = (isset($received_data['app_id'])) ? $received_data['app_id'] : '';
            $verification_type = (isset($received_data['verification_type'])) ? $received_data['verification_type'] : '';
            if ($app_id != '' || $verification_type != '') {
                #process data
                $return_array = Api::get_site_details($app_id, $verification_type, $response->user_id);
                if (!empty($return_array)) {
                    return Api::api_response($response->api_usage_id, 1, 'Site Details', $return_array);
                } else {
                    return Api::api_response($response->api_usage_id, 2, '', '', '1005');
                }
            } else {
                return Api::api_response($response->api_usage_id, 2, '', '', '1006');
            }
        } else {
            return $response->response;
        }
    }

    public function actionUpdateSiteStatus() {
        $response = Api::process_api_request('UpdateSiteStatus', Yii::$app->getRequest()->getUserIP());
        if (!empty($response->api_usage_id)) {
            $received_data = $response->received_data;
            $verification_id = (isset($received_data['verification_id'])) ? $received_data['verification_id'] : '';
            $verification_status = (isset($received_data['verification_status'])) ? $received_data['verification_status'] : '';
            if ($verification_id != '' || $verification_status != '') {
                #process data
                $return_status = Api::update_site_status($verification_id, $verification_status, $response->user_id);
                if (!empty($return_status)) {
                    return Api::api_response($response->api_usage_id, 1, 'Status Updated', $return_status);
                } else {
                    return Api::api_response($response->api_usage_id, 2, '', '', '1005');
                }
            } else {
                return Api::api_response($response->api_usage_id, 2, '', '', '1006');
            }
        } else {
            return $response->response;
        }
    }
    
    public function actionUpdateSiteDetails() {
        $response = Api::process_api_request('UpdateSiteDetails', Yii::$app->getRequest()->getUserIP());
        if (!empty($response->api_usage_id)) {
            $received_data = $response->received_data;
            $verification_type = (isset($received_data['verification_type'])) ? $received_data['verification_type'] : '';
            #process data
            $return_status = Api::update_site_details($received_data, $verification_type, $response->user_id);
            if ($return_status['status'] == 'success') {
                return Api::api_response($response->api_usage_id, 1, 'Details Updated', $return_status);
            } else {
                return Api::api_response($response->api_usage_id, 2, $return_status['msg'], '', '1006');
            }
        } else {
            return $response->response;
        }
    }

    public function actionUploadPhotos() {
        $response = Api::process_api_request('UploadPhotos', Yii::$app->getRequest()->getUserIP());
        if (!empty($response->api_usage_id)) {
            $received_data = $response->received_data;
            $app_id = (isset($received_data['app_id'])) ? $received_data['app_id'] : '';
            $photos_type = (isset($received_data['photos_type'])) ? $received_data['photos_type'] : '';
            $photos_section = (isset($received_data['photos_section'])) ? $received_data['photos_section'] : '';
            $photos_file_name = (isset($received_data['photos_file_name'])) ? $received_data['photos_file_name'] : '';
            if ($app_id != '' || $photos_type != '' || $photos_section != '' || $photos_file_name != '') {
                #process data
                $return_status = Api::upload_photos($received_data, $response->user_id);
                if ($return_status['status'] == 'success') {
                    return Api::api_response($response->api_usage_id, 1, 'Photo Uploaded', $return_status);
                } else {
                    return Api::api_response($response->api_usage_id, 2, $return_status['msg'], '', '1005');
                }
            } else {
                return Api::api_response($response->api_usage_id, 2, '', '', '1006');
            }
        } else {
            return $response->response;
        }
    }
    
    public function actionAddNocMetPerson() {
        $response = Api::process_api_request('AddNocMetPerson', Yii::$app->getRequest()->getUserIP());
        if (!empty($response->api_usage_id)) {
            $received_data = $response->received_data;
            $app_id = (isset($received_data['app_id'])) ? $received_data['app_id'] : '';
            $met_person = (isset($received_data['met_person'])) ? $received_data['met_person'] : '';
            $designation = (isset($received_data['designation'])) ? $received_data['designation'] : '';
            $remarks = (isset($received_data['remarks'])) ? $received_data['remarks'] : '';
            if ($app_id != '' || $met_person != '' || $designation != '' || $remarks != '') {
                #process data
                $return_status = Api::add_noc_met_person($received_data, $response->user_id);
                if ($return_status['status'] == 'success') {
                    return Api::api_response($response->api_usage_id, 1, 'Noc Met Person Added', $return_status);
                } else {
                    return Api::api_response($response->api_usage_id, 2, $return_status['msg'], '', '1006');
                }
            } else {
                return Api::api_response($response->api_usage_id, 2, '', '', '1006');
            }   
        } else {
            return $response->response;
        }
    }
    
    public function actionDeletePhotosNoc() {
        $response = Api::process_api_request('DeletePhotosNoc', Yii::$app->getRequest()->getUserIP());
        if (!empty($response->api_usage_id)) {
            $received_data = $response->received_data;
            $id = (isset($received_data['id'])) ? $received_data['id'] : '';
            $type = (isset($received_data['type'])) ? $received_data['type'] : '';
            if ($id != '' || $type != '') {
                #process data
                $return_status = Api::delete_photos_noc($received_data, $response->user_id);
                if ($return_status['status'] == 'success') {
                    return Api::api_response($response->api_usage_id, 1, 'Data Deleted', $return_status);
                } else {
                    return Api::api_response($response->api_usage_id, 2, $return_status['msg'], '', '1006');
                }
            } else {
                return Api::api_response($response->api_usage_id, 2, '', '', '1006');
            }  
        } else {
            return $response->response;
        }
    }
}
