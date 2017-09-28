<?php
    session_start();
    include("autoloader.php");
    $db = new Database();
    $connection = $db->getConnection(); 
    //handle incoming data
    $method = $_SERVER["REQUEST_METHOD"];
    if($method == "POST")
    {
        //array to hold the errors
        $errors = array(); 
        
        //new object to check the fields
        $newValidation = new Validation();
        
        
        $firstName = filter_var($_POST["firstName"],FILTER_SANITIZE_STRING);
        $lastName = filter_var($_POST["lastName"],FILTER_SANITIZE_STRING);
        
        $isFirstNameValid = $newValidation->checkName($firstName);
        $isLastNameValid = $newValidation->checkName($lastName);
        
        if(!$isFirstNameValid)
        {
            if($firstName == null){
                $errors["firstName"] = "Please fill out this field.";
            }
            else{
                $errors["firstName"] = "First Name Criteria (Max: 16 characteres).";
            }
        }
        
        if(!$isLastNameValid)
        {
            if($lastName == null){
                $errors["lastName"] = "Please fill out this field.";
            }
            else{
                $errors["lastName"] = "Last Name Criteria (Max: 16 characteres).";
        
            }
        }
        
        //EMAIL
        $email = filter_var($_POST["emailvar"],FILTER_SANITIZE_EMAIL);
        $isEmailValid = $newValidation->checkEmail($email);
        
        if(!$isEmailValid)
        {
            if($email == null){
                $errors["email"] = "Please fill out this field.";
            }
            else{
                $errors["email"] = "E-mail is not valid.";
            }
        }
        
        //PHONE
        $phone = $_POST["phone"];
        $isPhoneValid = $newValidation->checkPhone($phone);
        
        if(!$isPhoneValid)
        {
            if($phone == null){
                $errors["phone"] = "Please fill out this field.";
            }
            else{
                $errors["phone"] = "Only numbers on Phone.";
            }
        }
        
        //PASSWORDS
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];
        $isPasswordValid = $newValidation->checkPassword($password1,$password2);
        
        if(!$isPasswordValid)
        {
            if($password1 == null || $password2 == null){
                $errors["password"] = "Please fill out this field.";
            }
            else{
                $errors["password"] = "Password min: 8 characteres, or Passwords do not match.";
            }
        }
        
        $errorscount = count($errors);
        
        //Create user
        if($errorscount == 0)
        {
            $password = password_hash($_POST["password1"],PASSWORD_DEFAULT);
            
            //USER LEVEL 
            //2 = admin level
            //1 = user level
            $userLevel = 1;
            
            //USER STATUS 
            //2 = inactive
            //1 = active
            $userStatus = 1;
            
            $title = $_POST["title"];
            $user_request = $_POST["user_request"];
            
            if($user_request == "" OR $user_request == null)
            {
                $user_request = "-";
            }
            
            //Create query string
            $register_query = "INSERT INTO user 
                                (title, first_name, last_name, password, phone, email, user_request, level, user_status, date_created, last_access)
                                VALUES('$title','$firstName','$lastName','$password',?,?,'$user_request',$userLevel,$userStatus, NOW(), NOW())";
                               
            $statement = $connection->prepare($register_query);
            $statement -> bind_param("ss",$phone, $email);
            
            if($statement -> execute() ){
                echo "signup-ok";
            }
            else{
                if(mysqli_errno($connection) == "1062" || strpos(mysqli_error($connection),"email")){
                    $errors["email"] = "Email already used";
                }
                if(mysqli_errno($connection) == "1062" || strpos(mysqli_error($connection),"phone")){
                    $errors["phone"] = "Phone already used";
                }
                echo json_encode($errors);
            }
        }
        else{
            
             echo json_encode($errors);
        }
    }

?>