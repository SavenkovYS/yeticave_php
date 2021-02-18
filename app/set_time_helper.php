<?php
function set_time($array = [], $should_set_seconds = false) : array
{
    if(count($array)) {
        for ($i = 0; $i < count($array); $i++) {
            $hours_until_expire = floor($array[$i]['time_until_expire'] / 3600);
            if ($hours_until_expire < 10) {
                $hours_until_expire = "0" . $hours_until_expire;
            }
            $minutes_until_expire = floor($array[$i]['time_until_expire'] % 3600 / 60);
            if ($minutes_until_expire < 10) {
                $minutes_until_expire = "0" . $minutes_until_expire;
            }
            if ($should_set_seconds) {
                $seconds_until_expire = floor($array[$i]['time_until_expire'] % 60);
                if ($seconds_until_expire < 10) {
                    $seconds_until_expire = "0" . $seconds_until_expire;
                }
                $array[$i]['time_until_expire'] = $hours_until_expire . ":" . $minutes_until_expire . ":" . $seconds_until_expire;
            } else {
                $array[$i]['time_until_expire'] = $hours_until_expire . ":" . $minutes_until_expire;
            }
        }
    }
    return $array;
}
