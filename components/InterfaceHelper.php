<?php

namespace app\components;

use yii\base\Object;

/**
 * Interface Helper Class
 *
 * @author pratik
 */
class InterfaceHelper extends Object {

    /**
     * Normalize interface name
     * 
     * @param string $interface
     * @return string
     */
    public static function normalizeInterface($interface) {
        $pattern = "/^(" . implode("|", ["Te", "Gi", "Gig"]) . ")([0-9\/])+$/";
        if (preg_match($pattern, $interface)) {
            $search = ["Te", "Gig", "Gi"];
            $replace = ["TenGigabitEthernet", "GigabitEthernet", "GigabitEthernet"];
            $interface = str_replace($search, $replace, $interface);
        }
        return $interface;
    }

}
