<?php

namespace app\components;

use app\models\DeviceCredentials;
use Exception;
use yii\base\InvalidParamException;
use yii\base\Object;
/**
 * SnmpHelper - Helper class for snmp related functions
 *
 * @author pratik
 */
class SnmpHelper extends BaseObject {

    const SNMP_REQUEST_TYPE_GET = 'get';
    const SNMP_REQUEST_TYPE_WALK = 'walk';

    public $credentials = [];
    public $versions = [];
    private $host;
    private $user_id;
    private $successfulCredential = [];

    public function __construct($config = array()) {
        parent::__construct($config);
        @snmp_set_valueretrieval(SNMP_VALUE_PLAIN);
    }

    /**
     * Test SNMP Connection and load credentials
     */
    public function connect($host, $user_id) {
        $this->host = $host;
        $this->user_id = $user_id;
        $this->successfulCredential = [];
        if (empty($this->credentials)) {
            $this->credentials = self::getSnmpDeviceCredentials($this->host, $this->user_id, $this->versions);
        }
        if (empty($this->credentials)) {
            throw new InvalidParamException("Credentials not found.");
        }
        $response = null;
        foreach ($this->credentials as $credential) {
            $version = $credential['snmp_version'];
            $community = $credential['snmp_community'];
            $object_id = "sysObjectID.0";
            switch ($version) {
                case "v1":
                    $response = @snmpget($host, $community, $object_id);
                    break;
                case "v2c":
                    $response = @snmp2_get($host, $community, $object_id);
                    break;
            }
            if ($response) {
                $this->successfulCredential = $credential;
                break;
            }
        }
        if (!$this->successfulCredential) {
            throw new Exception("Credentials didn't work.");
        }
        return $this;
    }

    /**
     * Performs snmp collection get/walk
     * 
     * @param string|array $object_id
     * @param string $request_type
     * @return array|boolean
     * @throws Exception
     */
    public function collect($object_id, $request_type = self::SNMP_REQUEST_TYPE_GET) {
        if (!$this->successfulCredential) {
            return FALSE;
        }
        $collection = [];
        $version = $this->successfulCredential['snmp_version'];
        $community = $this->successfulCredential['snmp_community'];
        if (is_string($object_id)) {
            $object_id = [$object_id];
        }
        foreach ($object_id as $oid) {
            $response = null;
            switch ($version) {
                case "v1":
                    if ($request_type === self::SNMP_REQUEST_TYPE_GET) {
                        $response = @snmpget($this->host, $community, $oid);
                    } else if ($request_type === self::SNMP_REQUEST_TYPE_WALK) {
                        $response = @snmprealwalk($this->host, $community, $oid);
                    }
                    break;
                case "v2c":
                    if ($request_type === self::SNMP_REQUEST_TYPE_GET) {
                        $response = @snmp2_get($this->host, $community, $oid);
                    } else if ($request_type === self::SNMP_REQUEST_TYPE_WALK) {
                        $response = @snmp2_real_walk($this->host, $community, $oid);
                    }
                    break;
            }
            if ($response) {
                $collection[$oid] = $response;
            }
        }
        return $collection;
    }

    /**
     * Returns SNMP device credentials
     * 
     * @return array
     */
    public static function getSnmpDeviceCredentials($host, $user_id, $versions = []) {
        $result = [];
        if (empty($versions)) {
            $versions = [DeviceCredentials::SNMP_VERSION_V2C, DeviceCredentials::SNMP_VERSION_V1];
        }
        foreach ($versions as $version) {
            $credentials = DeviceCredentials::getDeviceCredentials(DeviceCredentials::PROTOCOL_SNMP, $user_id, $version, $host);
            if ($credentials['success']) {
                $result = array_merge($result, $credentials['data']);
            }
        }
        return $result;
    }

}
