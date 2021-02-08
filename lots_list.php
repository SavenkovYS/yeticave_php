<?php
    $lots = [
            ['id' => 1,
             'name' => '2014 Rossognol District Snowboard',
             'category' => 'Доски и лыжи',
             'price' => '10999',
             'url' => 'img/lot-1.jpg'],
            ['id' => 2,
             'name' => 'DC Ply Mens 2016/2017 Snowboard',
             'category' => 'Доски и лыжи',
             'price' => '159999',
             'url' => 'img/lot-2.jpg'],
            ['id' => 3,
             'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
             'category' => 'Крепления',
             'price' => '8000',
             'url' => 'img/lot-3.jpg'],
            ['id' => 4,
             'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
             'category' => 'Ботинки',
             'price' => '10999',
             'url' => 'img/lot-4.jpg'],
            ['id' => 5,
             'name' => 'Куртка для сноуборда DC Mutiny Charocal',
             'category' => 'Одежда',
             'price' => '7500',
             'url' => 'img/lot-5.jpg'],
            ['id' => 6,
             'name' => 'Маска Oakley Canopy',
             'category' => 'Разное',
             'price' => '5400',
             'url' => 'img/lot-6.jpg'],
        ];

    $products_categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];

    session_start();

    if(isset($_SESSION['user'])) {
        $is_auth = true;

        $user_name = $_SESSION['user']['name'];
        $user_avatar = 'img/user.jpg';
    } else {
        $is_auth = false;

        $user_name = null;
        $user_avatar = null;
    }
