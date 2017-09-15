<?php
    session_start();
    //Process Login
    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] == "login"){
        $user = $_POST["user"];
        $password = $_POST["password"];
        
        if(filter_var($user, FILTER_VALIDATE_EMAIL)){
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
            $user_id = $userdata["id"];
            $user_firstName = $userdata["first_name"];
            $user_lastName = $userdata["last_name"];
            $user_email = $userdata["email"];
            $level = $userdata["level"];
            
            //Verify password
            if(password_verify($password, $stored)){
                echo "Welcome $user_firstName!";
                $_SESSION["user_email"] = $user_email;
                $_SESSION["user_firstName"] = $user_firstName;
                $_SESSION["level"] = $level;
                
            }
            else{
                echo "Wrong credentials supplied";
            }
        }
        else{
            echo "Account does not exist!";
        }
    }
?>

<!-- Modal -->
<div id="loginModal" class="modal fade" role="dialog">
  <div class="modal-dialog" id="loginWidth">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="text-center">
                 <img class="logo-img" src="../images/smart-booking-logo.png"></img>
            </div>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form id="login-form" action="index.php" method="post">
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
                            <input type="checkbox" value="1" id="rememberMe" name="rememberMe"> Remember me
                        </div>
                        <div class="form-group">
                            <a href="#">Forgot password?</a>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit" value="login" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
  </div>
</div>