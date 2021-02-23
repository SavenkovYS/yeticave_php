<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');

if (!isset($_SESSION['user'])) {
    session_start();
}

if (!$link) {
    $error = mysqli_connect_error();
} else {
    $sql = 'SELECT * FROM `users`';
    $result = mysqli_query($link, $sql);

    if ($result) {
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($link);
    }
}

if (isset($_SESSION['user'])) {
    $is_auth = true;
    $user_name = $_SESSION['user']['name'];
    $user_avatar = isset($_SESSION['user']['avatar']) ? "uploads/avatars/" . $_SESSION['user']['avatar'] : "img/user.jpg";
} else {
    $is_auth = false;
    $user_name = null;
    $user_avatar = null;
}
