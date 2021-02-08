<?php
    require_once('lots_list.php');
    require_once('functions.php');

    $lot = null;

    if(isset($_GET['id'])) {
        $lot_id = (int)$_GET['id'];

        foreach ($lots as $item) {
            if($item['id'] === $lot_id) {
                $lot = $item;
                break;
            }
        }
    }

    if(!$lot) {
        http_response_code(404);
    }

    $counter_name = "lot_count";
    $counter_value = [$lot['id']];
    $expire = strtotime("+30 days");
    $path = "/";

    if (isset($_COOKIE['lot_count'])) {
        $is_repeated = false;
        $counter_value = json_decode($_COOKIE['lot_count']);
        foreach($counter_value as $item) {
            if($item === $lot['id'] or !isset($lot['id'])) {
                $is_repeated = true;
            }
        }
        if($is_repeated === false) {
            $counter_value[] = $lot['id'];
        }
    }

    $counter_value = json_encode($counter_value);

    setcookie($counter_name, $counter_value, $expire, $path);

    $page_content = include_template('./templates/lot.php', [
        'lot' => $lot,
        'is_auth' => $is_auth
    ]);

    $layout_content = include_template('./templates/layout.php', [
        'content' => $page_content,
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar
    ]);

    echo $layout_content;


