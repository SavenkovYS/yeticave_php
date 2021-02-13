<?php
require_once('init.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!$link) {
    $error = mysqli_connect_error();
} else {
    $sql = 'SELECT * FROM `lots`';
    $result = mysqli_query($link, $sql);

    if ($result) {
        $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
        for ($i = 0; $i < count($lots); $i++) {
            $time_until_expire = strtotime($lots[$i]['expire_ts']) - time();
            $lots[$i]['time_until_expire'] = $time_until_expire;
        }
    } else {
        $error = mysqli_error($link);
    }
}

if(!$link) {
    $error = mysqli_connect_error();
} else {
    $sql = 'SELECT * FROM `categories`';
    $result = mysqli_query($link, $sql);

    if ($result) {
        $products_categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($link);
    }
}


