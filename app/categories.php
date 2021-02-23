<?php
if (!$link) {
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
