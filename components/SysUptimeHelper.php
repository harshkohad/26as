<?php

namespace app\components;

use yii\base\InvalidParamException;

/**
 * Description of SysUptimeHelper
 *
 * @author Pratik
 */
class SysUptimeHelper {

    const TICKS_PER_SECOND = 100;
    const TICKS_PER_MINUTE = 6000;
    const TICKS_PER_HOURS = 360000;
    const TICKS_PER_DAYS = 8640000;

    /**
     * Translate uptime to days, hours, minutes and seconds
     * 
     * @param int $uptime milliseconds
     * @return [] $days, $hours, $minutes, $seconds
     */
    public static function translateUptime($uptime) {
        if (!is_numeric($uptime)) {
            throw new InvalidParamException("`uptime` must be of integer type.");
        }
        $seconds = intval($uptime / self::TICKS_PER_SECOND) % 60;
        $minutes = intval($uptime / self::TICKS_PER_MINUTE) % 60;
        $hours = intval($uptime / self::TICKS_PER_HOURS) % 24;
        $days = intval($uptime / self::TICKS_PER_DAYS);
        return [$days, $hours, $minutes, $seconds];
    }

    /**
     * Convert uptime to human readble format
     * 
     * @param int $uptime
     * @return string
     */
    public static function toString($uptime) {
        list($days, $hours, $minutes, $seconds) = self::translateUptime($uptime);
        if ($days) {
            return sprintf("%d days %d hours %d minutes %d seconds", $days, $hours, $minutes, $seconds);
        } else if ($hours) {
            return sprintf("%d hours %d minutes %d seconds", $hours, $minutes, $seconds);
        } else if ($minutes) {
            return sprintf("%d minutes %d seconds", $minutes, $seconds);
        }
        return sprintf("%d seconds", $seconds);
    }

}
