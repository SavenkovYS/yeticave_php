<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/app/set_time_helper.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/functions.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/winner.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/userdata.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/lots_list.php');

date_default_timezone_set('Europe/Moscow');

$lots = set_time($lots, false);

$page_content = include_template('./templates/index.php', [
        'lots' => $lots
]);

$layout_content = include_template('./templates/layout.php', [
        'products_categories' => $products_categories,
        'content' => $page_content,
        'title' => 'Главная',
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar
]);

echo $layout_content;
