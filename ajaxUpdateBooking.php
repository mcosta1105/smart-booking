<?php

  session_start();
  include("autoloader.php");
  
  //UPDATE BOOKING AJAX
  if($_POST['table'] && !$booking_updated)
  {
    
    $user_changed = $_SESSION["phone"];
    $booking_id = $_SESSION["booking_id"];
    
    $table_no = $_POST["table"];
    
    //STATUS Not Seated = 1
    $booking_status = 1;
    
    $booking_confirm_query = "UPDATE booking SET
                      status = '".$booking_status."',
                      table_id = '".$table_no."',
                      user_id = ?,
                      user_changed = ?
                      WHERE
                      id = '".$booking_id."'";
    
    $db = new Database();
    $connection = $db->getConnection();
        
    $booking_confirm_statement = $connection->prepare($booking_confirm_query);
    $booking_confirm_statement->bind_param('ss', $user_changed,$user_changed);
    $booking_confirm_statement->execute();
    
    if($booking_confirm_statement->affected_rows == 1)
    {
        $booking_updated = true;
        echo "booking-confirmed";
    }
    else
    {
        echo "error";
    }
    
    $booking_confirm_statement->close();
  }  
  
?>