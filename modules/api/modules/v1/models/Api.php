<?php

namespace app\modules\api\modules\v1\models;

use Yii;
use app\modules\api\modules\v1\models\Api;
use app\modules\api\modules\v1\models\TblApiUsage;
use app\modules\api\modules\v1\models\TblOauthAccessTokens;
use app\modules\api\modules\v1\models\TblApiErrors;

/**
 * 
 */
class Api extends \yii\db\ActiveRecord {
    /*
      @purpose = Get Input Data
      @author = hwk
     */

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

    function gen_token($client_id) {
        $access_token = new TblOauthAccessTokens();
        $token = Api::random_string(40);
        $token_expiry = date('Y-m-d H:i:s', strtotime('1 year'));

        #check if token already present
        $token_details = TblOauthAccessTokens::find()->where(['client_id' => $client_id])->one();
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
            $access_token->client_id = $client_id;
            $access_token->expires = $token_expiry;

            $access_token->save(false);
        }

        $return_array = array(
            "access_token" => $token,
            "expires_in" => floor((strtotime($token_expiry) - strtotime(date('Y-m-d H:i:s'))) / (60 * 60 * 24))
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
            'IsSuccess' => $issuccess,
            'Data' => $response_data,
            'Message' => $response_message
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
                $res_array['Error'] = $error_array;
            } else {

                $error_data = TblApiErrors::find()->where(['code' => $error_code])->one();
                $error_msg = $error_data->message;
                $res_array['Error'] = array($error_code => $error_msg);
            }
        }

        $res_json = Api::encode_to_json($res_array);

        $TblApiUsage = TblApiUsage::findOne(["id" => $api_usage_id]);
        $TblApiUsage->response_data = serialize($res_json);
        $TblApiUsage->response_date = date("Y-m-d H:i:s");

        $TblApiUsage->save(false);

        //return JSON
        return $res_json;
    }

}
