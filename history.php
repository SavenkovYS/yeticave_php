<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/lots_list.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/userdata.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/init.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/categories.php');

// Индексы посещенных лотов

$lots_indices = [];

if (isset($_COOKIE['lot_count'])) {
    $lots_indices = json_decode($_COOKIE['lot_count']);
}

if (!$link) {
    $error = mysqli_connect_error();
    $page_content = include_template('./templates/history.php', ['error' => $error]);
} else {
    $lots = [];

    // Перебираем индексы

    foreach ($lots_indices as $index) {

        // Находим лоты

        $sql = "SELECT * FROM `lots` WHERE `id` = '$index'";
        $result = mysqli_query($link, $sql);
        if ($result) {
            $lot = mysqli_fetch_assoc($result);

            // Устанавливаем им категорию по id

            for ($i = 0; $i < count($products_categories); $i++) {
                if ($lot['categories_id'] === $products_categories[$i]['id']) {
                    $lot['category'] = $products_categories[$i]['name'];
                    break;
                }
            }

            // Добавляем в массив ко всем посещенным лотам

            $lots[] = $lot;
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
    'content' => $page_content,
    'title' => 'История посещений',
    'user_name' => $user_name,
    'user_avatar' => $user_avatar
]);

echo $layout_content;
