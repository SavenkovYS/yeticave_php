<?php
	require_once ('functions.php');
    require_once ('lots_list.php');
    require_once ('init.php');
    require_once ('userdata.php');

	date_default_timezone_set('Europe/Moscow');

	for ($i = 0; $i < count($lots); $i++) {
	    $hours_until_expire = floor($lots[$i]['time_until_expire'] / 3600);
        $minutes_until_expire = floor($lots[$i]['time_until_expire'] % 3600 / 60);
        $lots[$i]['time_until_expire'] = $hours_until_expire . ":" . $minutes_until_expire;
    }



	$page_content = include_template('./templates/index.php', [
			'lots' => $lots
	]);

	$layout_content = include_template('./templates/layout.php', [
			'products_categories' => $products_categories,
			'content' => $page_content,
			'title' => 'Главная',
			'is_auth' => $is_auth,
			'user_name' => $user_name,
			'user_avatar' => $user_avatar
	]);

	echo $layout_content;
