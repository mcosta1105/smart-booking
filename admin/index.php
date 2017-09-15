<!DOCTYPE html>
<html>
    <?php
        session_start(); //GET and POST request
        
        $pageTitle = "Smart Booking - Administrator";
        
        include("includes/head.php");
        include("autoloader.php");
        
        $db = new Database();
        $connection = $db->getConnection();
        
        //Login
        if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] == "login")
        {
            $user = $_POST["user"];
            $password = $_POST["password"];
            
            if(filter_var($user, FILTER_VALIDATE_EMAIL))
            {
                $login_query = "SELECT * FROM user WHERE email=?";
            }
            else{
                $login_query = "SELECT * FROM user WHERE phone=?";
            }
            
            $statement = $connection->prepare($login_query);
            $statement->bind_param("s", $user);
            $statement->execute();
            
            $result = $statement->get_result();
            
            //Check if user is registered
            if($result->num_rows > 0)
            {
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
                $stored = $userdata["password"];
                $user_firstName = $userdata["first_name"];
                $level = $userdata["level"];
                
                //Verify Password and Level
                if(password_verify($password, $stored))
                {
                    if($level == 2) //2 == ADMIN, 1 == USER
                    {
                        //echo "Welcome $user_firstName!";
                        $_SESSION["user_firstName"] = $user_firstName;
                        header("Location: home.php"); 
                        exit;
                    }
                    else {
                        $error = "$user_firstName is not Administrator!";
                    }
                }
                else{
                    $error = "Wrong credentials supplied";
                }
            }
            else{
                $error = "Account does not exist!";
            }
        }
    ?>
    <body class="login">
        <div class="container-fluid">
            <div class="row vertical-center">
                <div class="col-md-4 col-md-offset-4 col-xs-8 col-xs-offset-2">
                    <form id="login-form" action="index.php" method="post">
                        <div class="text-center">
                             <img class="logo-img" src="../images/smart-booking-logo.png"></img>
                        </div>
                        <h3 class="form-title text-center">Sign In to your Account</h3>
                        <div class="form-group">
                            <label for="">Email or Phone number</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" type="text" id="user" placeholder="email or phone number" name="user" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input class="form-control" type="password" id="password" placeholder="your password" name="password" required/>    
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
                        </div>
                        <div class="form-group">
                            <a href="#">Forgot password?</a>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit" value="login" class="btn btn-primary">Login</button>
                            <span class="error">
                            <?php echo $error; ?>
                            </span>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
