<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/functions.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/userdata.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/lots_list.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/app/mysql_helper.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form = $_POST;

    $required = ['email', 'password', 'name', 'message'];
    $errors = [];

     foreach ($required as $field) {
         if (empty($form[$field])) {
             $errors[$field] = 'Это поле необходимо заполнить';
         }
     }

 // Проверка почты

     if (!count($errors) && is_email_used($form['email'], $users)) {
         $errors['email'] = 'Такая почта уже используется';
     } elseif (!count($errors) && !filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
         $errors['email'] = 'Введите корректные данные Вашей почты';
     }

 // Загрузка аватара

     if (isset($_FILES['avatar']['name'])) {
         $tmp_name = $_FILES['avatar']['tmp_name'];
         $path = $_FILES['avatar']['name'];

         $finfo = finfo_open(FILEINFO_MIME_TYPE);
         $file_type = finfo_file($finfo, $tmp_name);
         if ($file_type !== "image/jpeg" && $file_type !== "image/png") {
             $errors['files'] = 'Загрузите аватар в формате JPG или PNG';
         } else {
             move_uploaded_file($tmp_name, 'uploads/avatars/' . $path);
             $form['path'] = $path;
         }
     }

 // Загрузка нового пользователя в БД

     if (!count($errors)) {
         if (!$link) {
             $error = mysqli_connect_error();
             $page_content = include_template('./templates/sign-up.php', ['error' => $error]);
         } else {
             $query_data = [
                 htmlspecialchars($form['email']),
                 htmlspecialchars($form['name']),
                 password_hash($form['password'], PASSWORD_DEFAULT),
                 htmlspecialchars($form['message']),
                 isset($form['path']) ? $form['path'] : null
             ];

             $sql = 'INSERT INTO `users` (`email`, `name`, `password`, `message`, `avatar`) VALUES (?, ?, ?, ?, ?)';
             $stmt = db_get_prepare_stmt($link, $sql, $query_data);
             $result = mysqli_stmt_execute($stmt);

             if (!$result) {
                 $error = mysqli_error($link);
                 $page_content = include_template('./templates/sign-up.php', ['error' => $error]);
             }
         }
     }

     // Отрисовка страницы с ошибками

     if (count($errors)) {
         $page_content = include_template('./templates/sign-up.php', [
             'errors' => $errors,
             'form' => $form
         ]);
     } else {
         header("Location: /login.php");
     }
} else {
    $page_content = include_template('./templates/sign-up.php', []);
}

$layout_content = include_template('./templates/layout.php', [
    'products_categories' => $products_categories,
    'content' => $page_content,
    'title' => 'Регистрация',
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar
]);

echo $layout_content;
