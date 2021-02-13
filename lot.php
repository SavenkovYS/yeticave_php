<?php
    require_once ('lots_list.php');
    require_once ('functions.php');
    require_once ('userdata.php');

    for ($i = 0; $i < count($lots); $i++) {
        $hours_until_expire = floor($lots[$i]['time_until_expire'] / 3600);
        if ($hours_until_expire < 10) {
            $hours_until_expire = "0" . $hours_until_expire;
        }
        $minutes_until_expire = floor($lots[$i]['time_until_expire'] % 3600 / 60);
        if ($minutes_until_expire < 10) {
            $minutes_until_expire = "0" . $minutes_until_expire;
        }
        $seconds_until_expire = floor($lots[$i]['time_until_expire'] % 60);
        if ($seconds_until_expire < 10) {
            $seconds_until_expire = "0" . $seconds_until_expire;
        }
        $lots[$i]['time_until_expire'] = $hours_until_expire . ":" . $minutes_until_expire . ":" . $seconds_until_expire;
    }

    $lot = null;

    if(isset($_GET['id'])) {
        $lot_id = $_GET['id'];

        foreach ($lots as $item) {
            if($item['id'] == $lot_id) {
                $lot = $item;
                break;
            }
        }
    }

    $title = $lot['name'];

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
        'title' => $title,
        'content' => $page_content,
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar,
        'products_categories' => $products_categories,
    ]);

    echo $layout_content;


