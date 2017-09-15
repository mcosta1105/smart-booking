
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
                                <span class="help-block">
                                    <?php echo $errors["username"];?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input class="form-control" type="password" id="password" placeholder="your password" name="password" required/>
                                <span class="help-block">
                                    <?php echo $errors["password"];?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" value="1" id="rememberMe" name="rememberMe"> Remember me
                        </div>
                        <div class="form-group">
                            <a href="#">Forgot password?</a>
                        </div>
                        <div class="text-center">
                            <button id="loginButton" onclick="checkLogin()" name="submit" value="login" class="btn btn-primary">Login</button>
                        </div>
                        <div id="login"></div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
  </div>
</div>

<script>
    function checkLogin() {
        document.getElementById("loginButton").disabled = true;
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("loginButton").disabled = false;
            if(this.responseText== "true"){
                window.location.reload();
            }else{
                document.getElementById("login").innerHTML = this.responseText;
            }
        }
      };
      var username = document.getElementById("user");
      var password = document.getElementById("password");
      xhttp.open("POST", "includes/ajaxLogin.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("user="+username.value+"&password="+password.value);
            }
</script>