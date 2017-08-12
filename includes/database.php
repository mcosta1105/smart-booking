<?php
$user = "smart-booking";
$dbpassword = "123456789";
$host = "localhost";
$database = "smart-booking";
$connection = mysqli_connect($host,$user,$dbpassword,$database);

if(!$connection){
    echo "connection error";
}

?>