<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/lots_list.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/userdata.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/mysql_helper.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/categories.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lot = $_POST;

    $required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    $errors = [];

    // Проверяем форму на наличие ошибок

    foreach ($required as $field) {
        if (empty($lot[$field])) {
            $errors[$field] = 'Это поле необходимо заполнить';
        }
    }

    if (time() > strtotime($lot['lot-date'])) {
        $errors['lot-date'] = "Выберете корректную дату";
    }

    if ($lot['lot-rate'] <= 0 && !is_int(floatval($lot['lot-rate']))) {
        $errors['lot-rate'] = "Укажите корректную цену";
    }

    if ($lot['lot-step'] <= 0 && !is_int(floatval($lot['lot-rate']))) {
        $errors['lot-step'] = "Укажите корректную ставку";
    }

    if ($lot['category'] === 'Выберите категорию') {
        $errors['category'] = 'Выберите, пожалуйста, категорию';
    }

    // Загружаем изображение лота

    if (isset($_FILES['lot-image']['name'])) {
        $tmp_name = $_FILES['lot-image']['tmp_name'];
        $path = $_FILES['lot-image']['name'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        if ($file_type !== "image/jpeg" && $file_type !== "image/png") {
            $errors['files'] = 'Загрузите картинку в формате PNG или JPG';
        } else {
            move_uploaded_file($tmp_name, 'uploads/lot_img/' . $path);
            $lot['path'] = $path;
        }
    } else {
        $errors['file'] = 'Вы не загрузили файл';
    }

    // Отпраляем лот в БД

    if (!count($errors)) {
        if (!$link) {
            $error = mysqli_connect_error();
            $page_content = include_template('./templates/add.php', ['error' => $error]);
        } else {
            foreach ($products_categories as $category) {
                if ($category['name'] === $lot['category']) {
                    $lot['category_id'] = $category['id'];
                }
            }
            $query_data = [
                htmlspecialchars($lot['lot-name']),
                $lot['category_id'],
                htmlspecialchars($lot['message']),
                "uploads/lot_img/" . $lot['path'],
                htmlspecialchars($lot['lot-rate']),
                htmlspecialchars($lot['lot-step']),
                time(),
                strtotime($lot['lot-date']),
                $_SESSION['user']['id']
            ];

            $sql = 'INSERT INTO `lots` (`name`, `categories_id`, `description`, `img`, `price`, `step`, `create_ts`, `expire_ts`, `users_id`)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';

            $stmt = db_get_prepare_stmt($link, $sql, $query_data);
            $result = mysqli_stmt_execute($stmt);

            // Переадресовываем на страницу лота при успехе

            if ($result) {
                header('Location: lot.php?id=' . mysqli_insert_id($link));
            } else {
                $error = mysqli_connect_error();
                $page_content = include_template('./templates/add.php', ['error' => $error]);
            }
        }
    }

    // Отрисовываем страницу при наличии ошибок в форме

    if (count($errors)) {
        $page_content = include_template('./templates/add.php', [
            'lot' => $lot,
            'errors' => $errors,
        ]);
    }

} else {
    $page_content = include_template('./templates/add.php', []);
}

$layout_content = include_template('./templates/layout.php', [
    'products_categories' => $products_categories,
    'content' => $page_content,
    'title' => 'Добавить лот',
    'user_name' => $user_name,
    'user_avatar' => $user_avatar
]);

echo $layout_content;

