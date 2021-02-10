<?php
 require_once('functions.php');
 require_once('lots_list.php');
 require_once('init.php');
 require_once('./app/mysql_helper.php');
 require_once('userdata.php');

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $form = $_POST;

     $required = ['email', 'password', 'name', 'message'];
     $errors = [];

     foreach ($required as $field) {
         if (empty($form[$field])) {
             $errors[$field] = 'Это поле необходимо заполнить';
         }
     }

     if(!count($errors) and isEmailUsed($form['email'], $users)) {
         $errors['email'] = 'Такая почта уже используется';
     }

     if(!count($errors)) {
         if (!$link) {
             $error = mysqli_connect_error();
             $page_content = include_template('./templates/sign-up.php', ['error' => $error]);
         } else {
             $email = $form['email'];
             $username = $form['name'];
             $password = password_hash($form['password'], PASSWORD_DEFAULT);
             $message = $form['message'];

             $query_data = [
                 $email,
                 $username,
                 $password,
                 $message
             ];

             $sql = 'INSERT INTO `users` (`email`, `name`, `password`, `message`) VALUES (?, ?, ?, ?)';
             $stmt = db_get_prepare_stmt($link, $sql, $query_data);
             $result = mysqli_stmt_execute($stmt);
         }
     }

     if(count($errors)) {
         $page_content = include_template('./templates/sign-up.php', [
             'errors' => $errors,
             'form' => $form
         ]);
     } else {
//         header("Location: /index.php");
     }
 } else {
     $page_content = include_template('./templates/sign-up.php', []);
 }

 $layout_content = include_template('./templates/layout.php', [
     'products_categories' => $products_categories,
     'content' => $page_content,
     'title' => 'Главная',
     'is_auth' => $is_auth,
     'user_name' => $user_name,
     'user_avatar' => $user_avatar
 ]);

 echo $layout_content;
