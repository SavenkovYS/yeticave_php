<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/userdata.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/lots_list.php');

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form = $_POST;

    $required = ['email', 'password'];
    $map = ['email' => 'Почта', 'password' => 'Пароль'];
    $errors = [];

    foreach ($required as $field) {
        if (empty($form[$field])) {
            $errors[$field] = 'Это поле надо заполнить';
        }
    }

    // Проверка почты

    if (!count($errors) and $user = search_user_by_email($form['email'], $users)) {

        // Проверка правильности пароля

        if (password_verify($form['password'], $user['password'])) {
            $_SESSION['user'] = $user;
        } else {
            $errors['password'] = 'Неверный пароль';
        }
    } else {
        $errors['email'] = 'Такой пользователь не найден';
    }

    if (count($errors)) {
        $login_content = include_template('./templates/login.php', ['form' => $form, 'errors' => $errors]);
    } else {
        header("Location: /index.php");
        exit();
    }
} else {
    if (isset($_SESSION['user'])) {
        $login_content = include_template('./templates/login.php', ['username' => $_SESSION['user']['name']]);
    } else {
        $login_content = include_template('./templates/login.php', []);
    }
}

$layout_content = include_template('./templates/layout.php', [
    'content' => $login_content,
    'title' => 'Вход в аккаунт',
    'user_name' => $user_name,
    'user_avatar' => $user_avatar
]);

echo $layout_content;
