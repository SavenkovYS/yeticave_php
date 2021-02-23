<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/lots_list.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/userdata.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');

$lots_indices = [];

if (isset($_COOKIE['lot_count'])) {
    $lots_indices = json_decode($_COOKIE['lot_count']);
}

if (!$link) {
    $error = mysqli_connect_error();
    $page_content = include_template('./templates/history.php', ['error' => $error]);
} else {
    $lots = [];
    foreach ($lots_indices as $index) {
        $sql = "SELECT * FROM `lots` WHERE `id` = '$index'";
        $result = mysqli_query($link, $sql);
        if ($result) {
            $lot = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $lots[] = $lot[0];
        } else {
            $error = mysqli_error($link);
            $page_content = include_template('./templates/history.php', ['error' => $error]);
        }
    }
}

$page_content = include_template('./templates/history.php', [
    'lots_indices' => $lots_indices,
    'lots' => $lots
]);

$layout_content = include_template('./templates/layout.php', [
    'products_categories' => $products_categories,
    'content' => $page_content,
    'title' => 'История посещений',
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar
]);

echo $layout_content;
