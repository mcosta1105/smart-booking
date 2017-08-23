<!DOCTYPE html>
<html>
    <?php
        $pageTitle = "Smart Booking - Administrator";
        include("includes/head.php");
    ?>
    <body class="login">
        <div class="logo">
 
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form id="login-form" action="index.php" method="post">
                        <h3 class="form-title text-center">Sign In to your Account</h3>
                        <div class="form-group">
                            <label for="">Username or email</label>
                            <input class="form-control" type="text" id="user" placeholder="username or email" name="user"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" id="password" placeholder="your password" name="password"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>