<?php

namespace app\components\network;

use Exception;
use Yii;
use yii\base\Component;

/**
 * Description of NetworkAdaptor
 *
 * @author ShriRam
 */
class NetworkAdaptor extends Component {

    public $useManualCredentials = TRUE;

    /**
     * 
     * @param array $data Contains various parameters
     * 'username' : (for ssh, telnet)
     * 'password' : (for ssh, telnet)
     * 'host' : (required)
     * 'community' : (for snmp)
     * 'version' : (for snmp)
     * 'protocol' : (required) value can one of ssh, telnet, snmp 
     * 'port' : to override default port being used
     * 'retry_count' : (not implemented yet) if device is not rechable then try to connect no of times (default is 3)
     * 
     */
    public function getTransportObj($host, $data = [], $credentials = []) {
        $return = '';
        try {
            if (!empty($data) && is_array($data) && !empty($data['protocol'])) {
                switch ($data['protocol']) {
                    case 'snmp' :
                        if (!empty($data['community'])) {
                            $return = new \NetSNMP();
                        }
                        break;
                    case 'telnet' :
                        $data['class'] = 'app\components\network\NetTelnet';
                        $return = $this->applyParams($host, $data, $credentials);
                        break;
                    case 'ssh' :
                        $data['class'] = 'app\components\network\NetSSH';
                        $return = $this->applyParams($host, $data, $credentials);
                        break;
                    default :
                        throw new custom\CustomException('Given protocol class does not exist.');
                }
            } else {
                throw new Exception('Provided data is not sufficient for transport object.');
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return $return;
    }

    private function applyParams($host, $data, $credentials = []) {
        try {
            $data['host'] = $host;
            $return = $this->createObject($data, TRUE);
            $credentials = $this->getCredentials($data, $credentials);
            if (empty($credentials)) {
                throw new Exception("No credentials provided/available.");
            }
            foreach ($credentials as $credential) {

                $return->setCrentials($credential);
                try {
                    if ($return->connect()) {
                        return $return;
                    }                    
                } catch (Exception $ex) {
                    if ($ex->getName() === 'CanNotConnect') {
                        throw $ex; // Future scope to implement retry count
                    } elseif ($ex->getName() === 'AuthenticationFailed') {
                        continue;
                    } else {
                        throw $ex;
                    }
                }
            }
            throw new Exception("No credentials worked.");
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    private function nulifyObject() {
        $data = [
            'class' => 'app\components\network\NetworkAbstract',
        ];
        Yii::$app->set('transport', $data);
    }

    private function createObject($data, $nullify = FALSE) {
        Yii::$app->set('transport', $data);
        $return = Yii::$app->transport;
        if ($nullify) {
            $this->nulifyObject();
        }
        return $return;
    }

    private function getCredentials($data, $credentials) {
        if ($this->useManualCredentials === TRUE) {
            if (!empty($this->filterCredentials($credentials))) {
                return $credentials;
            }

            if (!empty($data['username']) && !empty($data['password'])) {
                $return = [
                    [
                        'username' => $data['username'],
                        'password' => $data['password'],
                    ]
                ];
                if (isset($data['enable_password'])) {
                    $return['enable_password'] = $data['enable_password'];
                }
                return $return;
            }
            throw new Exception("Credentials can not be empty.");
        } else {
            // get credentials from devive_credentials module
        }
        return $return;
    }

    private function filterCredentials($credentials) {
        $return = [];
        if (!empty($credentials) && is_array($credentials)) {
            array_filter($credentials, function($credential) {
                return is_array($credential) && !empty($credential['username']) && !empty($credential['password']);
            });
            $return = $credentials;
        }
        return $return;
    }

}
