<?php
    require_once('functions.php');
    require_once ('lots_list.php');

    $lots_indices = [];

    if(isset($_COOKIE['lot_count'])) {
        $lots_indices = json_decode($_COOKIE['lot_count']);
    }

    $history_content = include_template('./templates/history.php', [
        'lots_indices' => $lots_indices,
        'lots' => $lots
    ]);

    echo $history_content;
