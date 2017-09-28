<?php

namespace app\components;

use InvalidArgumentException;
use yii\base\Component;
use yii\base\Exception;

/**
 * Description of IpAddressHelper
 *
 * @author Pratik Gotmare <pratikgotmare@ocatalog.com>
 */
class IpAddressHelper extends Component {

    public static $v4pattern = '/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/';
    public static $v6pattern = '/^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*$/';

    public static function incrementIpAddress($ip, $increment) {
        $addr = inet_pton($ip);
        for ($i = strlen($addr) - 1; $increment > 0 && $i >= 0; --$i) {
            $val = ord($addr[$i]) + $increment;
            $increment = $val / 256;
            $addr[$i] = chr($val % 256);
        }
        return inet_ntop($addr);
    }

    public static function decrementIpAddress($ip, $decrement) {
        $addr = inet_pton($ip);
        for ($i = strlen($addr) - 1; $decrement > 0 && $i >= 0; --$i) {
            $val = ord($addr[$i]) - $decrement;
            $decrement = $val / 256;
            $addr[$i] = chr($val % 256);
        }
        return inet_ntop($addr);
    }

    public static function getLastOctate($input_ipv6) {
        $octates = explode(":", $input_ipv6);
        if (count($octates) === 8) {
            $lastOctate = (string) $octates[7];
            $lastOctate = str_pad($lastOctate, 4, "0", STR_PAD_LEFT);
            return $lastOctate;
        }
        return null;
    }

    public static function getIncrementalIpPool($ipv6_address, $maxLastOcatate = "FF") {
        $ipv6IncrementalPool = array();
        if (!empty($ipv6_address)) {
            $input_ipv6 = trim($ipv6_address);
            $i = 1;
            while (1) {
                $input_ipv6 = strtoupper($input_ipv6);
                $lastOctate = self::getLastOctate($input_ipv6);
                if (!empty($lastOctate)) {
                    $maxOcatate = substr($lastOctate, 2, 2);
                    if (strtoupper($maxOcatate) === $maxLastOcatate) {
                        break;
                    }
                    #Get next IP
                    $next_ipv6 = strtoupper(self::incrementIpAddress($input_ipv6, 1));
                    $input_ipv6 = $next_ipv6;
                    $ipv6IncrementalPool[$i] = $next_ipv6;
                    $i++;
                } else {
                    break;
                }
            }
        }
        return $ipv6IncrementalPool;
    }

    public static function removeMaskFromIpv6Address($ipv6_address) {
        $tempArr = explode("/", $ipv6_address);
        if (is_array($tempArr)) {
            if (isset($tempArr[1])) {
                unset($tempArr[1]);
            }
            $ipv6_address = $tempArr[0];
        }
        return $ipv6_address;
    }

    public static function isOddEven($input_ipv4) {
        $octates = explode(".", $input_ipv4);
        if (isset($octates[3])) {
            if ($octates[3] % 2 === 0) {
                return "even";
            } else {
                return "odd";
            }
        }
        return null;
    }

    public static function getOtherIpInPair($ipv4) {
        $to_ipv4 = null;
        $oddEven = IpAddressHelper::isOddEven($ipv4);
        if ($oddEven === "even") {
            $to_ipv4 = IpAddressHelper::incrementIpAddress($ipv4, 1);
        } else if ($oddEven === "odd") {
            $to_ipv4 = IpAddressHelper::decrementIpAddress($ipv4, 1);
        }
        return $to_ipv4;
    }

    /**
     * Generate IPv4 pool based on subnet and mask
     * 
     * @param string $subnet e.g. 192.168.0.0
     * @param int $mask e.g. 24
     * @return array 
     * @throws Exception
     */
    public static function generateIPv4Pool($subnet, $mask) {
        if ($mask > 32) {
            throw new Exception('Incorrect mask.');
        }
        self::validateIP($subnet, 'v4');
        $tmp = explode(".", $subnet);
        $tmp[3] = 0;
        $subnet = implode(".", $tmp);
        $totalHosts = pow(2, (32 - $mask));
        $i = $totalHosts;
        $ip = $subnet;
        $pool = array();
        while ($i > 0) {
            $pool[] = $ip;
            $ip = IpAddressHelper::incrementIpAddress($ip, 1);
            $i--;
        }
        return $pool;
    }

    /**
     * Generate IPv6 pool based on subnet and mask
     * 
     * @param string $subnet
     * @param int $mask e.g. 120
     * @return array 
     * @throws Exception
     */
    public static function generateIPv6Pool($subnet, $mask) {
        if ($mask > 128) {
            throw new Exception('Incorrect mask.');
        }
        self::validateIP($subnet, 'v6');
        $tmp = explode(":", $subnet);
        $octateCount = count($tmp);
        if ($octateCount == 8) {
            $tmp[7] = 0;
        } else if ($octateCount < 8) {
            $missingOctateCount = 8 - $octateCount;
            for ($x = 0; $x < $missingOctateCount; $x++) {
                $tmp[] = 0;
            }
        }
        $subnet = implode(":", $tmp);
        $totalHosts = pow(2, (128 - $mask));
        $i = $totalHosts;
        $ip = $subnet;
        $pool = array();
        while ($i > 0) {
            $pool[] = $ip;
            $ip = IpAddressHelper::incrementIpAddress($ip, 1);
            //echo "\n[$i/$totalHosts]".$ip;
            $i--;
        }
        return $pool;
    }

    public static function validateIP($value, $version = 'v4') {
        $valid = (strtolower($version) === 'v6') ? preg_match(self::$v6pattern, $value) : preg_match(self::$v4pattern, $value);

        if (!$valid) {
            $message = 'This is not a valid IP' . $version . ' address.';
            throw new Exception($message);
        }
        return $valid;
    }

    public static function generatemaxIPv6($subnet, $totalHosts) {

        $newdata = IpAddressHelper::incrementIpAddress($subnet, $totalHosts - 1);
        return $newdata;
    }

    /**
     * Calculate remote interface ip address in /30 range
     * 
     * @param string $local_int_ip ip 192.168.10.1     
     * @return string
     */
    public static function calculateRemoteInterfaceIpAddress($local_int_ip) {
        try {
            self::validateIsIntIpValid($local_int_ip);
        } catch (InvalidArgumentException $ex) {
            return FALSE;
        }
        $l = ip2long($local_int_ip);
        if ($l % 2 === 0) {
            $remoteIntIp = long2ip($l - 1);
        } else {
            $remoteIntIp = long2ip($l + 1);
        }
        return $remoteIntIp;
    }

    /**
     * Validate if the interface IP is valid or not
     * 
     * @param string $local_int_ip
     * @param string $netmask Default is 255.255.255.252
     * @return boolean
     * @throws InvalidArgumentException
     */
    public static function validateIsIntIpValid($local_int_ip, $netmask = "255.255.255.252") {
        $netAddr = self::calculateNetworkAddress($local_int_ip, $netmask);
        if ($local_int_ip === $netAddr) {
            throw new InvalidArgumentException("Given IP address {$local_int_ip} is a subnet address.");
        }
        $lNetAddr = ip2long($netAddr);
        $lBroadcastAddr = $lNetAddr + 3;
        $broadCastAddr = long2ip($lBroadcastAddr);
        if ($local_int_ip === $broadCastAddr) {
            throw new InvalidArgumentException("Given IP address {$local_int_ip} is a broadcast address.");
        }
        return true;
    }

    /**
     * Calculate network address by IP and Mask
     * 
     * @param string $ip ip 192.168.10.1
     * @param string $netMask 255.255.255.252
     * @return string
     */
    public static function calculateNetworkAddress($ip, $netMask) {
        $inetIp = inet_pton($ip);
        $inetMask = inet_pton($netMask);
        $netAddr = $inetIp & $inetMask;
        return inet_ntop($netAddr);
    }

}
