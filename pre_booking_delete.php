<?php

    session_start();
    include("autoloader.php");
    
    $bookingID = $_SESSION["booking_id"];

    $delete_query = "DELETE FROM booking WHERE id = ? AND table_id = 0 AND status = 0";
    
    $db = new Database();
    $connection = $db->getConnection();
    
    $delete_statement = $connection->prepare($delete_query);
    $delete_statement->bind_param('i', $bookingID);
    $delete_statement->execute();
    $delete_statement->close();
    
?>