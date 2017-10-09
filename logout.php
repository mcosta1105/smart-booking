<?php
    session_start();
    unset($_SESSION["user_email"]);
    session_destroy();
    $origin = $_SERVER["HTTP_REFERER"];
    header("location: $origin");
?>