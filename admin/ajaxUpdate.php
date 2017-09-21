<?php

    include("autoloader.php");
    //Update
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $errors_update = array();
        $val_update = new Validation();
        
        $phone_update = $_POST["phone"];
        $title_update = $_POST["title"];
        $firstname_update = $_POST["firstName"];
        $lastname_update = $_POST["lastName"];
        $specialrequest_update = $_POST["message"];
        $level_update = $_POST["level"];
        $status_update = $_POST["status"];
    
        $firstname_update = filter_var($_POST["firstName"],FILTER_SANITIZE_STRING);
        $lastname_update = filter_var($_POST["lastName"],FILTER_SANITIZE_STRING);
        
        $isFnameValid = $val_update->checkName($firstname_update);
        $isLnameValid = $val_update->checkName($lastname_update);
        
        if(!$isFnameValid)
        {
            if($firstname_update == null)
            {
                $errors_update["firstName"] = "Please fill out this field.";
            }
            else{
                $errors_update["firstName"] = "First Name Criteria (Max: 16 characteres).";
            }
        }
        
        if(!$isLnameValid)
        {
            if($lastname_update == null)
            {
                $errors_update["lastName"] = "Please fill out this field.";
            }
            else
            {
                $errors_update["lastName"] = "Last Name Criteria (Max: 16 characteres).";
        
            }
        }
        
        $errors_update_counter = count($errors_update);
        
        if($errors_update_counter == 0)
        {
            //USER LEVEL 
            //2 = admin level
            //1 = user level
            if($level_update == "Admin")
            {
                $level_update = 2;
            }
            else
            {
                $level_update = 1;
            }
            
            //USER STATUS 
            //2 = inactive
            //1 = active
            if($status_update == "Active")
            {
                $status_update = 1;
            }
            else
            {
                $status_update = 2;
            }
            
            if($specialrequest_update == "" OR $specialrequest_update == null)
            {
                $specialrequest_update = "-";
            }
                
            //Update query
            $update_user_query =  "UPDATE user
                                   SET title = '".$title_update."',
                                   first_name = '".$firstname_update."', 
                                   last_name  = '".$lastname_update."',
                                   special_request = '".$specialrequest_update."',
                                   level = '".$level_update."',
                                   user_status = '".$status_update."'
                                   WHERE phone =?";
            
            $connection = mysqli_connect(getenv("dbhost"),getenv("dbuser"),getenv("dbpass"),
            getenv("dbname"));
              
            $update_statement = $connection->prepare($update_user_query);
            $update_statement->bind_param('s', $phone_update);
            $update_statement->execute();
    
            if($update_statement->affected_rows == 1)
            {
                echo "update-ok";
            }
            else
            {
                echo json_encode($errors_update);
            }
            //    $message = 'User updated';
            //else
              // $message = 'User not updated';
            
            $update_statement->close();
    
            //https://www.w3schools.com/bootstrap/bootstrap_alerts.asp
            //echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
?>