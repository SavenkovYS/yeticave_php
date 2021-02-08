<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    header("Location: /index.php");
    var_dump($_SESSION);
    unset($_SESSION['user']);


