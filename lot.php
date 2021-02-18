<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/app/set_time_helper.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/lots_list.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/functions.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/userdata.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/mysql_helper.php');

// Устанавливаем дату в необходимом формате

$lots = set_time($lots, true);

// Ищем текущий лот

$lot = null;

if (isset($_GET['id'])) {
    $lot_id = $_GET['id'];

    foreach ($lots as $item) {
        if ($item['id'] == $lot_id) {
            $lot = $item;
            break;
        }
    }
}

// Проверяем ставку и устанавливаем новую цену

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form = $_POST;
    $errors = [];

    if (empty($form['cost'])) {
        $errors['cost'] = 'Укажите Вашу ставку';
    }

    if ($form['cost'] < $lot['step'] + $lot['price']) {
        $errors['cost'] = 'Ваша ставка должна быть не меньше указанной суммы';
    }

    if (!is_numeric($form['cost'])) {
        $errors['cost'] = 'Укажите, пожалуйста, корректную ставку';
    }

    if (count($errors)) {
        $page_content = include_template('./templates/lot.php', [
            'errors' => $errors,
            'lot' => $lot,
            'is_auth' => $is_auth
        ]);
    } else {
        if (!$link) {
            $error = mysqli_connect_error();
            $page_content = include_template('./templates/lot.php', ['error' => $error]);
        } else {
            $sql = 'UPDATE `lots` SET `price` = ? WHERE (`id` = ?)';
            $stmt = db_get_prepare_stmt($link, $sql, [$form['cost'], $lot['id']]);
            $result = mysqli_stmt_execute($stmt);

            $sql = 'INSERT INTO `bets` (`user_id`, `lot_id`, `value`, `create_time`) VALUES (?, ?, ?, ?)';
            $stmt = db_get_prepare_stmt($link, $sql, [$_SESSION['user']['id'], $lot['id'], $form['cost'], time()]);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                header('Location: lot.php?id=' . $lot['id']);
            } else {
                $error = mysqli_error($link);
                $page_content = include_template('./templates/lot.php', ['error' => $error]);
            }
        }
    }
}

// Уставаливаем таблицу ставок

if (!$link) {
    $error = mysqli_connect_error();
    $page_content = include_template('./templates/lot.php', ['error' => $error]);
} else {
    $sql = 'SELECT u.name, b.value, b.create_time ' .
        'FROM `users` u ' .
        'JOIN `bets` b ON b.user_id = u.id ' .
        'WHERE lot_id=' . $lot['id'];

    $result = mysqli_query($link, $sql);
    if ($result) {
        $bets = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($link);
        $page_content = include_template('./templates/lot.php', ['error' => $error]);
    }
}

// Если перешли на страницу с несуществующим лотом

if (!$lot) {
    http_response_code(404);
    exit();
}

// Устанавливаем куки с информации о посещенном лоте

$counter_name = "lot_count";
$counter_value = [$lot['id']];
$expire = strtotime("+30 days");
$path = "/";

if (isset($_COOKIE['lot_count'])) {
    $counter_value = json_decode($_COOKIE['lot_count']);
    $counter_value[] = $lot['id'];
    $counter_value = array_unique($counter_value);
}

$counter_value = json_encode($counter_value);

setcookie($counter_name, $counter_value, $expire, $path);

$page_content = include_template('./templates/lot.php', [
    'lot' => $lot,
    'is_auth' => $is_auth,
    'bets' => $bets
]);

$layout_content = include_template('./templates/layout.php', [
    'title' => $lot['name'],
    'content' => $page_content,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'products_categories' => $products_categories,
]);

echo $layout_content;


