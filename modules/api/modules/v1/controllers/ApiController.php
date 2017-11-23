<?php

namespace app\modules\api\modules\v1\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use mdm\admin\models\User;
use app\modules\api\modules\v1\models\Api;
use app\modules\manage_mobile_app\models\TblMobileUsers;
use app\modules\api\modules\v1\models\TblOauthIdentity;

/**
 * A UserController Class.
 * User activities from version one can be controlled here.
 *
 * @author Harshwardhan Kohad <harsh.kohad@gmail.com>
 * @created_on : 29 Sept, 2017
 * @package 

 */
class ApiController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'app-login' => ['post'],
                    'get-access-token' => ['post'],
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
                            $oauth_details = TblOauthIdentity::find()->where(['user_id' => $user_details->id])->one();

                            #Generate token and save it into db
                            $return_array = Api::gen_token($oauth_details->client_id);

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
                #Check if client_id and client secret is valid or not
                $client_id = $received_data_data['client_id'];
                $client_secret = $received_data_data['client_secret'];

                $oauth_details = TblOauthIdentity::find()->where(['client_id' => $client_id, 'client_secret' => $client_secret])->one();

                if (!empty($oauth_details)) {
                    #Register API usage
                    $api_usage_id = Api::api_usage($received_data['access_token'], $api_name, $ip_address, $received_data['data']);

                    #Generate token and save it into db
                    $return_array = Api::gen_token($client_id);

                    $response = Api::api_response($api_usage_id, 1, 'API Access Token.', $return_array);
                }
            }
        } else {
            $response = Api::api_response($api_usage_id, 2, '', '', '1000');
        }

        return $response;
    }

}
