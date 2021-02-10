<?php
require_once ('init.php');

if(!$link) {
    $error = mysqli_connect_error();
} else {
    $sql = 'SELECT * FROM `users`';
    $result = mysqli_query($link, $sql);

    if($result) {
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($link);
    }
}
