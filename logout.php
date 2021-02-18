<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    header("Location: /index.php");
    unset($_SESSION['user']);


