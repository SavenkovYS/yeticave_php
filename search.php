<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/init.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/lots_list.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/userdata.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/categories.php');

if (!$link) {
    $error = mysqli_connect_error();
} else {
    $search = trim($_GET['search']) ?? '';
    $search = mysqli_real_escape_string($link, $search);

    $cur_page = $_GET['page'] ?? 1;
    $page_items = 6;

    $result = mysqli_query(
        $link,
        "SELECT COUNT(*) as cnt FROM `lots` " . "WHERE MATCH(`name`, `description`) AGAINST ('%$search%' IN BOOLEAN MODE)");

    $items_count = mysqli_fetch_assoc($result)['cnt'];

    $pages_count = ceil($items_count / $page_items);
    $offset = ($cur_page - 1) * $page_items;

    $pages = range(1, $pages_count);

    $sql = "SELECT * FROM `lots` " .
        "WHERE MATCH(`name`, `description`) AGAINST ('%$search%' IN BOOLEAN MODE) " .
        "ORDER BY `expire_ts` DESC LIMIT " . $page_items . " OFFSET " . $offset;

    if ($result = mysqli_query($link, $sql)) {
        $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
        for ($i = 0; $i < count($lots); $i++) {
            for ($j = 0; $j < count($products_categories); $j++) {
                if ($products_categories[$j]['id'] == $lots[$i]['categories_id']) {
                    $lots[$i]['category'] = $products_categories[$j]['name'];
                    break;
                }
            }
        }
        $page_content = include_template('./templates/search.php', [
            'lots' => $lots,
            'pages' => $pages,
            'pages_count' => $pages_count,
            'cur_page' => $cur_page,
            'search' => $search
        ]);
    } else {
        $error = mysqli_error($link);
        $page_content = include_template('./templates/search.php', ['error' => $error]);
    }
}

$layout_content = include_template('./templates/layout.php', [
    'products_categories' => $products_categories,
    'content' => $page_content,
    'title' => 'Поиск',
    'user_name' => $user_name,
    'user_avatar' => $user_avatar
]);

echo $layout_content;
