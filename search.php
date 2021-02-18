<?php
require_once ('init.php');
require_once ('lots_list.php');
require_once ('functions.php');
require_once ('userdata.php');

if (!$link) {
    $error = mysqli_connect_error();
} else {
    $search = trim($_GET['search']) ?? '';
    $search = mysqli_real_escape_string($link, $search);

    $sql = "SELECT * FROM `lots` " .
           "WHERE `name` LIKE '%$search%' OR `description` LIKE '%$search%'";
    if ($result = mysqli_query($link, $sql)) {
        $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $page_content = include_template('./templates/search.php', [
            'lots' => $lots,
            'search' => $search
        ]);
    } else {
        $page_content = include_template('./templates/search.php', []);
    }
}

$layout_content = include_template('./templates/layout.php', [
    'products_categories' => $products_categories,
    'content' => $page_content,
    'title' => 'Поиск',
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar
]);

echo $layout_content;
