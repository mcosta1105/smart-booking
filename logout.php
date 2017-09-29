<?php
    session_start();
    session_destroy();
    //unset($_SESSION["user_email"]);
    $origin = $_SERVER["HTTP_REFERER"];
    header("location: $origin");
?>