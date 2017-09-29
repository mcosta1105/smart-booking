<?php
    session_start();
    include("autoloader.php");
    
    //Process Login
    if($_POST['user'] && $_POST['password'])
    {
        $user = $_POST["user"];
        $password = $_POST["password"];
    }
    else if($_POST['booking-user'] && $_POST['booking-password'])
    {
        $user = $_POST["booking-user"];
        $password = $_POST["booking-password"];
    }
    
    if($user == null || $password == null)
    {
        echo "<center><p class=\"error\">Please fill out all fields.</p></center>";
    }
    else{
        //array to hold the errors
        $errors = array();
        
        if(filter_var($user, FILTER_VALIDATE_EMAIL)){
            $login_query = "SELECT * FROM user WHERE email=?";
        }
        else{
            $login_query = "SELECT * FROM user WHERE phone=?";
        }
        
        $db = new Database();
        $connection = $db->getConnection();
            
        $statement = $connection->prepare($login_query);
        $statement->bind_param("s", $user);
        $statement->execute();
        $result = $statement->get_result();
        
        //Check if user is registered
        if($result->num_rows > 0){
            
            //Set cookie for user
            
            if(isset($_POST["rememberMe"])){
                //setcookie("user", $user, time()+60*60*7);
                echo "Remember User";
                $expiry = time()+60*60*7;
                $_SESSION["expiry"] = $expiry;
            }
            if($_SESSION["expiry"]){
                $now = time();
                $diff = $now - $_SESSION["expiry"];
                if($diff>0){
                    // 
                    unset($_SESSION["expiry"]);
                    //get user to login again
                    unset($_SESSION["user_email"]);
                    $needtologin = true;
                }
            }
            
            $userdata = $result->fetch_assoc();
            //check for password macthing
            $stored = $userdata["password"];
            $user_phone = $userdata["phone"];
            $user_firstName = $userdata["first_name"];
            $user_lastName = $userdata["last_name"];
            $user_email = $userdata["email"];
            $level = $userdata["level"];
            $user_status = $userdata["user_status"];
            
            if($user_status == 1)//Active
            {
                //Verify password
                if(password_verify($password, $stored)){
                    $_SESSION["user_email"] = $user_email;
                    $_SESSION["user_firstName"] = $user_firstName;
                    $_SESSION["level"] = $level;
                    $_SESSION["phone"] = $user_phone;
                    echo "login-ok";
                }
                else{
                echo "<center><p class=\"error\">Wrong credentials supplied.</p></center>";
                }
            }
            else{
                echo "<center><p class=\"error\">Account is Inactive!</p></center>";
            }
        }
        else{
            echo "<center><p class=\"error\">Account does not exist!</p></center>";
        }
    }
?>