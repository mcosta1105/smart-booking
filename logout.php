<?php
    session_start();
    unset($_SESSION["user_email"]);
    $origin = $_SERVER["HTTP_REFERER"];
    header("location: $origin");
?>