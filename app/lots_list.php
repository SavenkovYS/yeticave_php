<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/init.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/categories.php');

if (!$link) {
    $error = mysqli_connect_error();
} else {
    $cur_page = $_GET['page'] ?? 1;
    $page_items = 6;

    $result = mysqli_query($link, "SELECT COUNT(*) as cnt FROM `lots`");
    $items_count = mysqli_fetch_assoc($result)['cnt'];

    $pages_count = ceil($items_count / $page_items);
    $offset = ($cur_page - 1) * $page_items;

    $pages = range(1, $pages_count);

    $sql = "SELECT * FROM `lots` " .
    "ORDER BY `expire_ts` DESC LIMIT " . $page_items . " OFFSET " . $offset;

    $result = mysqli_query($link, $sql);
    if ($result) {
        $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);

        for ($i = 0; $i < count($lots); $i++) {
            if ($lots[$i]['expire_ts'] > time()) {
                $lots[$i]['time_until_expire'] = $lots[$i]['expire_ts'] - time();
            } else {
                $lots[$i]['time_until_expire'] = 0;
            }
        }

        // Устанавливаем категорию товара по индексу

        for ($i = 0; $i < count($lots); $i++) {
            for ($j = 0; $j < count($products_categories); $j++) {
                if ($products_categories[$j]['id'] == $lots[$i]['categories_id']) {
                    $lots[$i]['category'] = $products_categories[$j]['name'];
                    break;
                }
            }
        }

    } else {
        $error = mysqli_error($link);
    }
}

