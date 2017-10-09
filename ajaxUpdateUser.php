<?php

    include("autoloader.php");
    $valUserUpdate = new Validation();
    
    //Update
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $errorsUpdate = array();

        $phoneUpdate = $_POST["user-phone"];
        $titleUpdate = $_POST["user-title"];
        $firstnameUpdate = $_POST["user-firstName"];
        $lastnameUpdate = $_POST["user-lastName"];
        $userRequestUpdate = $_POST["user-request"];
    
        $firstnameUpdate = filter_var($_POST["user-firstName"],FILTER_SANITIZE_STRING);
        $lastnameUpdate = filter_var($_POST["user-lastName"],FILTER_SANITIZE_STRING);
        
        $is_FnameValid = $valUserUpdate->checkName($firstnameUpdate);
        $is_LnameValid = $valUserUpdate->checkName($lastnameUpdate);
        
        if(!$is_FnameValid)
        {
            if($firstnameUpdate == null)
            {
                $errorsUpdate["firstName"] = "Please fill out this field.";
            }
            else{
                $errorsUpdate["firstName"] = "First Name Criteria (Max: 16 characteres).";
            }
        }
        
        if(!$is_LnameValid)
        {
            if($lastnameUpdate == null)
            {
                $errorsUpdate["lastName"] = "Please fill out this field.";
            }
            else
            {
                $errorsUpdate["lastName"] = "Last Name Criteria (Max: 16 characteres).";
        
            }
        }
        
        $errorsUpdateCounter = count($errorsUpdate);
        
        if($errorsUpdateCounter == 0)
        {
            
            if($userRequestUpdate == "" OR $userRequestUpdate == null)
            {
                $userRequestUpdate = "-";
            }
                
            //Update query
            $updateUserQuery =  "UPDATE user
                                   SET title = '".$titleUpdate."',
                                   first_name = '".$firstnameUpdate."', 
                                   last_name  = '".$lastnameUpdate."',
                                   user_request = '".$userRequestUpdate."'
                                   WHERE phone =?";
            
            $database = new Database();
            $connection_db = $database->getConnection();
              
            $update_user_statement = $connection_db->prepare($updateUserQuery);
            $update_user_statement->bind_param('s', $phoneUpdate);
            $update_user_statement->execute();
            
    
            if($update_user_statement->affected_rows == 1)
            {
                echo "update-ok";
            }
            else
            {
                echo json_encode($errorsUpdate);
            }
            
            $update_user_statement->close();
        }
        else
        {
            echo json_encode($errorsUpdate);
        }
    }
?>