<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tbl_device_credentials".
 *
 * @property integer $id
 * @property string $label
 * @property string $username
 * @property string $password
 * @property string $enable_password
 * @property string $protocol
 * @property string $snmp_version
 * @property string $snmp_community
 * @property string $auth_type
 * @property string $privacy_type
 * @property string $include_devices
 * @property string $exclude_devices
 * @property integer $sort_order
 * @property string $created_at
 * @property string $modified_at
 * @property integer $created_by
 * @property integer $modified_by
 */
class DeviceCredentials extends \yii\db\ActiveRecord {

    /**
     * Protocols
     */
    const PROTOCOL_SSH = 'ssh';
    const PROTOCOL_TELNET = 'telnet';
    const PROTOCOL_SNMP = 'snmp';
    const SNMP_VERSION_V1 = 'v1';
    const SNMP_VERSION_V2C = 'v2c';
    const SNMP_VERSION_V3 = 'v3';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_device_credentials';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
//            [['label', 'sort_order', 'created_at', 'created_by', 'modified_by'], 'required'],
            [['label', 'sort_order'], 'required'],
            [['username', 'password'], 'required', 'when' => function($model) {
            return (in_array($model->protocol, array('ssh', 'telnet')) || ($model->protocol == 'snmp' && $model->snmp_version == 'v3'));
        }, 'whenClient' => "function (attribute, value) {
    return (($('#protocol').val() == 'ssh' || $('#protocol').val() == 'telnet') || ($('#protocol').val() == 'snmp' && $('#snmp_version').val() == 'v3'));
}"],
            ['snmp_community', 'required', 'when' => function($model) {
                    return ($model->protocol == 'snmp' && $model->snmp_version != 'v3');
                }, 'whenClient' => "function (attribute, value) {
    return ($('#protocol').val() == 'snmp' && $('#snmp_version').val() != 'v3');
}"],
            [['snmp_version', 'auth_type', 'privacy_type', 'include_devices', 'exclude_devices'], 'string'],
            [['include_devices', 'exclude_devices'], 'validateCommaSeperatedIPs'],
            [['sort_order'], 'integer', 'max' => 9],
            [['sort_order', 'created_by', 'modified_by'], 'validateUnsignedInt'],
            [['created_at', 'modified_at', 'is_global'], 'safe'],
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/', 'message' => '{attribute} can only contain alphanumeric characters, underscores and dashes.'],
            [['password', 'enable_password'], 'match', 'pattern' => '/^\S{0,20}$/', 'message' => '{attribute} can only contain alphanumeric or special characters.'],
            [['label', 'username', 'snmp_community'], 'string', 'max' => 50],
            [['password', 'enable_password'], 'string', 'max' => 20],
            [['protocol'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'username' => 'Username',
            'password' => 'Password',
            'enable_password' => 'Enable Password',
            'protocol' => 'Protocol',
            'snmp_version' => 'Snmp Version',
            'snmp_community' => 'Snmp Community',
            'auth_type' => 'Auth Type',
            'privacy_type' => 'Privacy Type',
            'include_devices' => 'Include Devices',
            'exclude_devices' => 'Exclude Devices',
            'sort_order' => 'Sort Order',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * Function to contain behaviour declation applied to this model
     * @return array()
     */
    public function behaviors() {
        return [
            'encryption' => [ // A behaviour for auto encryption and decryption for password fields.
                'class' => '\nickcv\encrypter\behaviors\EncryptionBehavior',
                'attributes' => [
                    'password',
                    'enable_password',
                ],
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'modified_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * A function for validating IPS on a comma seperated string
     * @param array $attribute
     * @param array $params
     */
    public function validateCommaSeperatedIPs($attribute, $params) {
        $arrParts = explode(",", $this->$attribute); // Splitting the IPv4s
        $failed = false;
        if (!is_array($arrParts)) { // checking if the string is comma seperated
            $failed = true;
        }
        foreach ($arrParts as $strIP) { // iterating over IPv4s to validate
            $strIP = trim($strIP);
            if ($strIP === '*' || $strIP === '*.*.*.*') { // If the IPv4 is general wildcard then considering it valid and moving to next iteration
                continue;
            }
            $arrSubParts = explode(".", $strIP); // Splitting the IP to perform further validation
            if (count($arrSubParts) != 4) { // If splitted IP part not having 4 values then it is not a valid IPv4
                $failed = true;
                break;
            } else if ($arrSubParts[0] === '0') { // If first part is starting with a zero then it is not a valid IPv4
                $failed = true;
                break;
            }
            foreach ($arrSubParts as $key => $ipPart) { // Iterating
                if ($key == (count($arrSubParts) - 1) && strpos($ipPart, '/') !== FALSE) { // if the IP given is a subnet identifier
//                    if (strpos($ipPart, '/') !== FALSE) { 
                    $lastPart = explode('/', $ipPart);
//                        var_dump(count($lastPart));exit;
                    if ($lastPart[0] > 255 || $lastPart[1] < 1 || $lastPart[1] > 32 || empty($lastPart[1]) || count($lastPart) > 2) {
                        $failed = true;
                        break;
                    }
                } else if (strpos($ipPart, '-') !== FALSE) { // if the IP given is range of IPv4s
                    $lastPart = explode('-', $ipPart);
                    if ($lastPart[0] > 254 || $lastPart[1] < $lastPart[0] || $lastPart[1] > 255 || empty($lastPart[1]) || count($lastPart) > 2) {
                        $failed = true;
                        break;
                    }
                } else if (!($ipPart === '*' || (ctype_digit($ipPart) && $ipPart <= 255))) { // If not a * wildcard or the value is greated than 255 then validation fails
                    $failed = true;
                    break;
                }
            }
//            exit;
            if ($failed) {
                break;
            }
        }
        if ($failed) { // If flag is set the validation fails. Generating the message for the same
            $this->addError($attribute, 'Please enter valid IPv4 addresses with subnet/range(optional) seperated by commas(,). You can also user wildcards e.g. *');
        }
    }

    public static function getDeviceCredentials($protocol, $createdBy, $version = null, $ipv4 = null) { // common function to fetch device credentials
//        echo '<pre>';
//        var_dump(func_get_args());exit;
        $protocol = trim(strtolower($protocol));
        $version = trim(strtolower($version));
        $ipv4 = trim($ipv4);
        $data = array();
        $success = true;
        $error_msg = null;
        try {
            if (empty($protocol)) { // If not protocol is provide
                throw new \Exception('Kindly provide a protocol.');
            }
            /* Preparing query on the basis of parameters */
            $selectCols = ['id as credential_id', 'label', 'username', 'password', 'enable_password', 'protocol',
                'snmp_version', 'snmp_community', 'auth_type', 'privacy_type',
                'include_devices', 'exclude_devices'];
            $sql = DeviceCredentials::find()->select($selectCols)->where(['protocol' => $protocol]);
            if ($protocol == 'snmp' && !empty($version)) {
                $sql = $sql->andWhere(['snmp_version' => $version]);
            }
            $sql->orderBy(['sort_order' => SORT_ASC, 'is_global' => SORT_ASC]);
            $sql->andFilterWhere(['or', [DeviceCredentials::tableName() . '.created_by' => $createdBy], [DeviceCredentials::tableName() . '.is_global' => 1]]);

            /* Query preperation ends */
//            echo $sql->createCommand()->getRawSql();exit;
            $count = $sql->count(); // getting count of results
            if (empty($count)) { // if count is 0
                throw new \Exception('No records found');
            }
            $data = $sql->asArray()->all(); // fetching data form database
            if (!empty($ipv4)) {
                $arrTemp = $data;
                foreach ($data as $key => $arrVals) {
                    if (!(DeviceCredentials::ipFallsInRange($ipv4, $arrVals['include_devices'])) || (DeviceCredentials::ipFallsInRange($ipv4, $arrVals['exclude_devices']) && !empty($arrVals['exclude_devices']))) {
                        unset($arrTemp[$key]);
                    } else {
                        $arrTemp[$key] = $arrVals;
                    }
                }
                $data = $arrTemp;
            }
            foreach ($data as &$arrVals) {
                if (!empty($arrVals['password'])) {
                    $arrVals['password'] = Yii::$app->encrypter->decrypt($arrVals['password']);
                }
                if (!empty($arrVals['enable_password'])) {
                    $arrVals['enable_password'] = Yii::$app->encrypter->decrypt($arrVals['enable_password']);
                }
                unset($arrVals['include_devices']);
                unset($arrVals['exclude_devices']);
            }
//            var_dump($data);
        } catch (\Exception $ex) { // Catching exception messages
            $success = false;
            $error_msg = $ex->getMessage();
        }
        return [ // returning the array to calling end
            'success' => $success,
            'error' => $error_msg,
            'data' => $data,
        ];
    }

    public static function ipFallsInRange($ip, $ip_range) {
        $ipLong = ip2long($ip);
        $arrIPs = explode(",", $ip_range);
        $arrIPs = array_map('trim', $arrIPs);
//        echo $ip;
//        var_dump($arrIPs);//exit;
        if (in_array('*', $arrIPs) || in_array('*.*.*.*', $arrIPs) || empty($ip_range)) {
            return true;
        } else if (in_array($ip, $arrIPs)) {
            return true;
        }
        foreach ($arrIPs as $strIp) {
            $min = $max = $minIp = $maxIp = null;
            if (strpos($strIp, '*') !== FALSE) {
                $arrIpPart = explode('.', $ip);
                $arrSubParts = explode('.', $strIp);
                $arrTemp = array();
                foreach ($arrSubParts as $key => $ipPart) {
                    if ($ipPart === '*') {
                        $arrTemp[$key] = $arrIpPart[$key];
                    } else {
                        $arrTemp[$key] = $ipPart;
                    }
                }
                if ($ip == implode('.', $arrTemp)) {
                    return true;
                }
            } else if (strpos($strIp, '-') !== FALSE) {
                $arrSubParts = explode('.', $strIp);
                $arrTemp['min'] = $arrSubParts;
                $arrTemp['max'] = $arrSubParts;
                foreach ($arrSubParts as $key => $ipPart) {
                    $arrPart = explode('-', $ipPart);
                    if (count($arrPart) == 2) {
                        $arrTemp['min'][$key] = $arrPart[0];
                        $arrTemp['max'][$key] = $arrPart[1];
                    }
                }
                $minIp = implode('.', $arrTemp['min']);
                $maxIp = implode('.', $arrTemp['max']);
            } else if (strpos($strIp, '/') !== FALSE) {
                @list($ip, $len) = explode('/', $strIp);
                if (($min = ip2long($ip)) !== false) {
                    $max = ($min | (1 << (32 - $len)) - 1);
                    $minIp = long2ip($min);
                    $maxIp = long2ip($max);
                }
            }
//            var_dump([$minIp, $maxIp]);
            $min = ip2long($minIp);
            $max = ip2long($maxIp);
            if ($ipLong >= $min && $ipLong <= $max) {
                return true;
            }
        }
        return false;
    }

    public function validateUnsignedInt($attribute, $params) {
//        var_dump($this->$attribute < 0);exit;
        if ($this->$attribute < 0) {
            $this->addError($attribute, 'Only positive value are allowed.');
        }
    }

    public function canSetGlobal() {
        $return = FALSE;
        if (!empty(Yii::$app->params['canSetGlobalCredentials'])) {
            $userRoles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
            if (is_array(Yii::$app->params['canSetGlobalCredentials'])) {
                foreach (Yii::$app->params['canSetGlobalCredentials'] as $role) {
                    if (array_key_exists($role, $userRoles)) {
                        $return = TRUE;
                        break;
                    }
                }
            } else if (array_key_exists(Yii::$app->params['canSetGlobalCredentials'], $userRoles)) {
                $return = TRUE;
            }
        }

        return $return;
    }

}
