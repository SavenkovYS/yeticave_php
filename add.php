<?php
    require_once('functions.php');
    require_once('lots_list.php');

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

        if(count($errors)) {
            $add_lot_content = include_template('./templates/add.php', [
                'lot' => $lot,
                'errors' => $errors,
                'map' => $map,
                'is_auth' => $is_auth
            ]);
        } else {
            $add_lot_content = include_template('./templates/lot.php', ['lot' => $lot]);
        }
    } else {
        $add_lot_content = include_template('./templates/add.php', ['is_auth' => $is_auth]);
    }

    echo $add_lot_content;
