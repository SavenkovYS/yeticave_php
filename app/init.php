<?php
$db = require_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);
mysqli_set_charset($link, "utf8");
