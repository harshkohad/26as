<?php

namespace app\components\network;

use yii\base\Component;
use app\components\custom\NamedException;

/**
 * Description of NetworkAbstract
 *
 * @author ShriRam
 */
abstract class NetworkAbstract extends \yii\base\Object {

    protected $_isConnected = false;
    protected $_isLoggedIn = false;
    protected $_socket;
    protected $username;
    protected $password;
    protected $enable_password;
    protected $retry_count = 3;
    protected $read_untill;
    public $host;
    public $protocol;
    public $port;
    public $credential_id;
    public $label;
    public $snmp_version;
    public $snmp_community;
    public $auth_type;
    public $privacy_type;
    public $log;
    public $rechable = TRUE;

    public function init() {
        parent::init();
        if (empty($this->host)) {
            throw new NamedException("Value of 'host' can not be empty.");
        }
    }

    protected function throwException($name, $msg) {
        $ex = new NamedException($msg);
        $ex->setName($name);
        throw $ex;
    }

    protected function log($output) {
        if ($this->log) {
            echo $output;
        }
    }

    public function getRead_untill() {
        return $this->read_untill;
    }

    public function appendRead_untill($text = '') {
        return $this->read_untill .= $text;
    }

    public function getCrentials() {
        $return = ['username' => $this->getUsername(), 'password' => $this->getPassword()];
        if (!empty($this->getEnable_password())) {
            $return['enable_password'] = $this->getEnable_password();
        }
        return $return;
    }

    public function setCrentials($credential) {
        if (!empty($credential['username']) && !empty($credential['password'])) {
            $this->setUsername($credential['username']);
            $this->setPassword($credential['password']);
            if (!empty($credential['enable_password'])) {
                $this->setEnable_password($credential['enable_password']);
            }
        }
        return $this;
    }

    public function isConnected() {
        if ($this->_isConnected) {
            $metaData = stream_get_meta_data($this->_socket);
            if (empty($metaData['timed_out'])) {
                return TRUE;
            }
        }
        return FALSE;
    }

    public function isLoggedIn() {
        return $this->_isLoggedIn;
    }

    public function getHost() {
        return $this->host;
    }

    public function getProtocol() {
        return $this->protocol;
    }

    public function getPort() {
        return $this->port;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEnable_password() {
        return $this->enable_password;
    }

    public function getSnmp_version() {
        return $this->snmp_version;
    }

    public function getSnmp_community() {
        return $this->snmp_community;
    }

    public function getAuth_type() {
        return $this->auth_type;
    }

    public function getPrivacy_type() {
        return $this->privacy_type;
    }

    public function getWaitTimeOut() {
        return $this->waitTimeOut;
    }

    public function getSocket() {
        return $this->_socket;
    }

    public function setHost($host) {
        $this->host = $host;
        return $this;
    }

    public function setProtocol($protocol) {
        $this->protocol = $protocol;
        return $this;
    }

    public function setPort($port) {
        $this->port = $port;
        return $this;
    }

    public function setLabel($label) {
        $this->label = $label;
        return $this;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setEnable_password($enable_password) {
        $this->enable_password = $enable_password;
        return $this;
    }

    public function setSnmp_version($snmp_version) {
        $this->snmp_version = $snmp_version;
        return $this;
    }

    public function setSnmp_community($snmp_community) {
        $this->snmp_community = $snmp_community;
        return $this;
    }

    public function setAuth_type($auth_type) {
        $this->auth_type = $auth_type;
        return $this;
    }

    public function setPrivacy_type($privacy_type) {
        $this->privacy_type = $privacy_type;
        return $this;
    }

    public function setWaitTimeOut($waitTimeOut) {
        $this->waitTimeOut = $waitTimeOut;
        return $this;
    }

    public function setSocket($socket) {
        $this->_socket = $socket;
        return $this;
    }

    public function getSession($credentials = []) {
        try {
            if (!$this->isConnected()) {
                $this->connect();
            }

            if (!$this->isLoggedIn()) {
                $this->login($credentials);
            }
            if ($this->isLoggedIn()) {
                return $this;
            } else {
                return FALSE;
            }
        } catch (NamedException $exc) {
            throw $exc;
        }
    }

    private function preparePingCommand($target) {
        $commnd = '';
        if (filter_var($target, FILTER_VALIDATE_IP)) {
            $commnd = "ping -c 3 -w 4 " . $target;
        }
        if (filter_var($target, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $commnd = "ping6 -c 3 -w 4 " . $target;
        }
        return $commnd;
    }

    public function ping($target = '') {
        if (empty($target)) {
            $target = $this->host;
        }
        $commnd = $this->preparePingCommand($target);
        if (!empty($commnd)) {
            $cmd_result = shell_exec($commnd);
        } else {
            return 'Invalid target IP';
        }
        $result = explode(",", $cmd_result);
        if (!empty($result[1])) {
            //if (!preg_match("/\s*(.*)\s+received/i", $result[1], $match) && $match[1] == '0') {
            if (preg_match("/0 received/i", $result[1])) {
                return 'Device is not rechable.';
            } else {
                return 'online';
            }
        } else {
            return 'Error Occured.';
        }
    }

    public function isRechable($target = '') {
        return TRUE;
        $return = FALSE;
        $status = $this->ping($target);
        if ('online' === $status) {
            $return = TRUE;
        }
        return $return;
    }

    protected function checkRechability($ip) {
        return TRUE;
        try {
            $output = $this->sendCommand("ping {$ip}");
            if (preg_match("/Success rate is (\d+) percent/", $output, $match)) {
                if ($match[1] != 0) {
                    return TRUE;
                }
            }
        } catch (NamedException $ex) {
            $this->log($ex->getMessage() . "\n");
        }
        return FALSE;
    }

}
