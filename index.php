<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/set_time_helper.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/winner.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/userdata.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/init.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/lots_list.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/categories.php');

date_default_timezone_set('Europe/Moscow');

$lots = set_time($lots, false);

$page_content = include_template('./templates/index.php', [
    'lots' => $lots,
    'pages' => $pages,
    'pages_count' => $pages_count,
    'cur_page' => $cur_page
]);

$layout_content = include_template('./templates/layout.php', [
    'products_categories' => $products_categories,
    'content' => $page_content,
    'title' => 'Главная',
    'user_name' => $user_name,
    'user_avatar' => $user_avatar
]);

echo $layout_content;
