<?php
require_once ('init.php');

if(!$link) {
    $error = mysqli_connect_error();
} else {

    $sql = "SELECT `id`, `expire_ts` FROM `lots` " .
    "WHERE `winner` IS NULL AND " . time() . " >= `expire_ts`";
    $result = mysqli_query($link, $sql);
    if($result) {
        $expired_lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($expired_lots as $lot) {
            $sql = "SELECT * FROM `bets` " .
                "WHERE `lot_id` = " . $lot['id'] .
                " ORDER BY `value` DESC";
            $result = mysqli_query($link, $sql);
            if ($result) {
                $bets = mysqli_fetch_all($result, MYSQLI_ASSOC);
                if (count($bets)) {
                    var_dump($bets[0]['user_id']);
                    $sql = "SELECT `id`, `name` FROM `users` " .
                        "WHERE `id` = " . $bets[0]['user_id'];
                    $result = mysqli_query($link, $sql);
                    if ($result) {
                        $winner = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        var_dump($winner[0]['name']);
                    }
                } else {
                    var_dump('Никто не поставил на ваш товар');
                }
            }
        }
    } else {
        $error = mysqli_error($link);
    }
}


 // "JOIN `bets` ON bets.lot_id = lots.id "
