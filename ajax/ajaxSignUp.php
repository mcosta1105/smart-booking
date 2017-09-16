<?php
    session_start();

    //handle incoming data
    $method = $_SERVER["REQUEST_METHOD"];
    if($method == "POST" && $_POST["submit"] == "register")
    {
        //array to hold the errors
        $errors = array();
        
        //new object to check the fields
        $newValidation = new Validation();
        
        
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        
        $isFirstNameValid = $newValidation->checkName($firstName);
        $isLastNameValid = $newValidation->checkName($lastName);
        
        if(!$isFirstNameValid)
        {
            $errors["firstName"] = "First Name Criteria (Max: 16 characteres).";
        }
        
        if(!$isLastNameValid)
        {
            $errors["lastName"] = "Last Name Criteria (Max: 16 characteres).";
        }
        
        //EMAIL
        $email = $_POST["email"];
        $isEmailValid = $newValidation->checkEmail($email);
        
        if(!$isEmailValid)
        {
            $errors["email"] = "E-mail is not valid.";
        }
        
        //PHONE
        $phone = $_POST["phone"];
        $isPhoneValid = $newValidation->checkPhone($phone);
        
        if(!$isPhoneValid)
        {
            $errors["phone"] = "Only numbers on Phone.";
        }
        
        //PASSWORDS
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];
        $isPasswordValid = $newValidation->checkPassword($password1,$password2);
        
        if(!$isPasswordValid)
        {
            $errors["password"] = "Password min: 8 characteres, or Passwords do not match.";
        }
        
        $errorscount = count($errors);
        
        //Create user
        if($errorscount == 0)
        {
            $password = password_hash($_POST["password1"],PASSWORD_DEFAULT);
            
            //USER LEVEL 
            //3 = user level
            //2 = edit level
            //1 = admin level
            $userLevel = 1;
            
            //USER STATUS 
            //2 = inactive
            //1 = active
            $userStatus = 1;
            
            $title = $_POST["title"];
            $special_request = $_POST["message"];
            
            if($special_request == "" OR $special_request == null)
            {
                $special_request = "-";
            }
            
            //Create query string
            $register_query = "INSERT INTO user 
                                (title, first_name, last_name, password, phone, email, special_request, level, status, date_created, last_access)
                                VALUES('$title','$firstName','$lastName','$password','$phone','$email','$special_request','$userLevel','$userStatus', NOW(), NOW())";
                               
            $db = new Database();
            $connection = $db->getConnection(); 
            
            $result = $connection->query($register_query);
            
            if(!$result)
            {
                //TODO
                echo "Error creating account";
                
                $error_code = mysqli_errno($connection);
                $error_msg = mysqli_error($connection);
                
                if($error_code == '1062' && stristr($error_msg,"email"))
                {
                    $errors["email"] = "Email already used";
                }
                else if($error_code == '1062' && stristr($error_msg,"phone"))
                {
                    $errors["phone"] = "Phone already used";
                }
                
                echo mysqli_error($connection).", code = ".$error_code;
            }
            else{
                echo "Account created";
            }
        }
    }

?>