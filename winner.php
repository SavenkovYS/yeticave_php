<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/init.php');

if (!$link) {
    $error = mysqli_connect_error();
} else {

    // Выбираем лоты с истекшим сроком

    $sql = "SELECT `id`, `expire_ts` FROM `lots` " .
    "WHERE `winner_id` IS NULL AND " . time() . " >= `expire_ts` " .
    "1";
    $result = mysqli_query($link, $sql);
    if ($result) {
        $expired_lots = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // В каждом лоте определяем самую высокую ставку

        foreach ($expired_lots as $lot) {
            $sql = "SELECT * FROM `bets` " .
                "WHERE `lot_id` = " . $lot['id'] .
                " ORDER BY `value` DESC LIMIT 1";
            $result = mysqli_query($link, $sql);
            if (mysqli_num_rows($result)) {

                // Записываем победителя в БД

                $winner = mysqli_fetch_assoc($result);
                $winner_sql = mysli_query($link, "UPDATE `lots` SET winner_id = " . $winner['id'] . " WHERE id = " . $lot['id']);
            } else {
                $message = 'Никто не поставил на ваш товар';
            }
        }
    } else {
        $error = mysqli_error($link);
    }
}
