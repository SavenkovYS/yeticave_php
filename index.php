<?php
	require_once('functions.php');
    require_once('lots_list.php');

	date_default_timezone_set('Europe/Moscow');
	$time_until_tomorrow = strtotime('tomorrow') - time();
	$hours_until_tomorrow = floor($time_until_tomorrow / 3600);
	$minutes_until_tomorrow = floor($time_until_tomorrow % 3600 / 60);

	function set_price($price) {
	    $formated_price = ceil($price);
	    if ($formated_price < 1000) {
	        return $formated_price;
	    } else {
	        return number_format($formated_price, 0, '', ' ');
	    }
	};

	$page_content = include_template('./templates/index.php', [
			'lots' => $lots,
			'hours_until_tomorrow' => $hours_until_tomorrow,
			'minutes_until_tomorrow' => $minutes_until_tomorrow
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
