<?php

  //Update booking with table choose
  $pre_booking_table_no = $_POST["table_id"];
  
  if($pre_booking_table_no != null)
  {

    $pre_booking_query = "UPDATE booking SET
                    table_id = '".$pre_booking_table_no."'
                    WHERE
                    id = '".$pre_booking_id."'";
  
    $db = new Database();
    $connection = $db->getConnection();
        
    $pre_booking_statement = $connection->prepare($pre_booking_query);
    $pre_booking_statement->execute();
    $pre_booking_statement->close();
  }  
   
?>