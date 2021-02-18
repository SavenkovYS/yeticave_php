<?php
const HOUR = 3600;
function set_date($ts) : string
{
    $creation_time = time() - $ts;
    $date = date('d.m.y в H:i', $ts);
    if ($creation_time > HOUR && $creation_time < 2 * HOUR) {
        return 'Час назад';
    }

    if ($creation_time < HOUR) {
        return floor($creation_time / 60) . ' минут назад';
    }
    return $date;
}
