<?php
    require_once ('functions.php');
    require_once ('lots_list.php');
    require_once ('userdata.php');
    require_once ('mysql_helper.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $lot = $_POST;

        $required = ['lot-name', 'category', 'message', 'lot-image', 'lot-rate', 'lot-step', 'lot-date'];
        $map = [
            'lot-name' => 'Название',
            'category' => 'Категория',
            'message' => 'Описание',
            'lot-image' => 'Изображение',
            'lot-rate' => 'Начальная стоимость',
            'lot-step' => 'Шаг ставки',
            'lot-date' => 'Дата окончания аукциона'
        ];
        $errors = [];
        foreach ($_POST as $key => $value) {
            if(in_array($key, $required)) {
                if (!$value) {
                    $errors[$map[$key]] = 'Это поле надо заполнить';
                }
            }
        }

        if(isset($_FILES['lot-image']['name'])) {
            $tmp_name = $_FILES['lot-image']['tmp_name'];
            $path = $_FILES['lot-image']['name'];

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_type = finfo_file($finfo, $tmp_name);
            if($file_type !== "image/jpeg") {
                $errors['files'] = 'Загрузите картинку в формате PNG или JPG';
            } else {
                move_uploaded_file($tmp_name, 'uploads/' . $path);
                $lot['path'] = $path;
            }
        } else {
            $errors['file'] = 'Вы не загрузили файл';
        }

        if(!count($errors)) {
            if(!$link) {
                $error = mysqli_connect_error();
                $page_content = include_template('./templates/add.php', ['error' => $error]);
            } else {
                var_dump($lot);
                $start_date = date('Y-m-d', time());
                $img_path = "uploads/" . $lot['path'];
                $query_data = [
                  $lot['lot-name'],
                  $lot['category'],
                  $lot['message'],
                  $img_path,
                  $lot['lot-rate'],
                  $lot['lot-step'],
                  $start_date,
                  $lot['lot-date']
                ];

                $sql = 'INSERT INTO `lots` (`name`, `category_id`, `description`, `img`, `price`, `step`, `create_ts`, `expire_ts`)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

                $stmt = db_get_prepare_stmt($link, $sql, $query_data);
                $result = mysqli_stmt_execute($stmt);
                $page_content = include_template('./templates/add.php', [
                    'lot' => $lot,
                    'map' => $map,
                    'is_auth' => $is_auth
                ]);

            }
        }

        if(count($errors)) {
            $page_content = include_template('./templates/add.php', [
                'lot' => $lot,
                'errors' => $errors,
                'map' => $map,
                'is_auth' => $is_auth
            ]);
        }

    } else {
        $page_content = include_template('./templates/add.php', ['is_auth' => $is_auth]);
    }

    $layout_content = include_template('./templates/layout.php', [
        'products_categories' => $products_categories,
        'content' => $page_content,
        'title' => 'Добавить лот',
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar
    ]);

    echo $layout_content;

