<?php
function set_price($price) : string
{
    $formated_price = ceil($price);
    if ($formated_price < 1000) {
        return $formated_price;
    } else {
        return number_format($formated_price, 0, '', ' ');
    }
}
