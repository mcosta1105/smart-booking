<?php

  session_start();
  //TODO UPDATE BOOKING AJAX
  if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] == "confirm-booking" && !$booking_updated)
  {
    
    $user_changed = $_SESSION["phone"];
    
    $table_no = $_POST["table"];
    
    //STATUS Not Seated = 1
    $booking_status = 1;
    
    $booking_confirm_query = "UPDATE booking SET
                      status = '".$booking_status."',
                      table_id = '".$table_no."'
                      WHERE
                      user_id = ?
                      AND status = 0";
    
    $booking_confirm_statement = $connection->prepare($booking_confirm_query);
    $booking_confirm_statement->bind_param('s', $user_changed);
    $booking_confirm_statement->execute();
    
    if($booking_confirm_statement->affected_rows == 1)
    {
        echo "booking-confirmed";
        $booking_updated = true;
    }
    else
    {
        echo "error";
    }
    
    $booking_confirm_statement->close();
  }  
  
?>
<!-- Booking Confirmation Modal -->
<div id="bookingConfirmationModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" id="body-modal">
<!-- Modal content-->
    <div class="modal-content">
      <form id="booking-confirmation-form" action= "<?php echo $currentpage; ?>" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title title-red">Booking Confirmation</h3>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-md-6" id="left-col">
                  <div id="option-btns">
                     <h3 class="title-red">Choose an Option</h3>
                      <div class="row text-center">
                          <div class="col-lg-12">
                              <button type="button" class="btn btn-danger" id="btn-login">&nbsp;Login&nbsp;</button>
                              <button type="button" class="btn btn-danger" id="btn-signup">Sign Up</button>
                          </div>
                      </div>
                    </div>
                    <div id="content-login" hidden>
                       <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <form id="login-form-booking" action="index.php" method="post">
                                      <div class="text-center">
                                           <img class="logo-img" src="../images/smart-booking-logo.png"></img>
                                      </div>
                                      <h3 class="form-title text-center">Login</h3>
                                      <div class="form-group">
                                          <label for="">Email or Phone number</label>
                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                              <input class="form-control" type="text" id="booking-user" placeholder="email or phone number" name="booking-user" required/>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="password">Password</label>
                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                              <input class="form-control" type="password" id="booking-password" placeholder="your password" name="booking-password" required/>    
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <input type="checkbox" value="1" id="rememberMe" name="rememberMe"> Remember me
                                      </div>
                                      <div class="form-group">
                                          <a href="#">Forgot password?</a>
                                      </div>
                                      <div class="text-center">
                                          <button id="loginBookingButton" onclick="checkBookingLogin()" name="submit" value="login" class="btn btn-primary">Login</button>
                                      </div>
                                      <div id="booking-login"></div>
                                    </form>
                                </div>
                            </div>
                            </div>
                      </div>
                    <div id="content-signup" hidden>
                        <h3 class="form-title text-center">Sign up</h3>
                        <form id="register-form" action="<?php echo $currentpage; ?>" method="post">
                        <?php
                            if($errors["firstName"])
                            {
                                $firstNameClass = "has-error";
                            }
                        ?>
                        <div class="form-group<?php echo $firstNameClass; ?>">
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="form-control" id="title" name="title">
            		                    <option>Mr.</option>
            		                    <option>Mrs.</option>
            		                    <option>Miss.</option>
            	                    </select>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" value="<?php echo $firstName; ?>" required>
                                    <span id="error-firstName" style="color:#d9534f;"></span>
                                </div>
                            </div>
                  			</div>
                  			<?php
                  			    if($errors["lastName"])
                  			    {
                  			        $lastNameClass = "has-error";
                  			    }
                  			?>
                  			<div class="form-group <?php echo $lastNameClass; ?>">
                  				<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
                  			    <span id="error-lastName" style="color:#d9534f;"></span>
                  			</div>
                  			<?php
                  			    if($errors["email"])
                  			    {
                  			        $emailClass = "has-error";
                  			    }
                  			?>
                  			<div class="form-group <?php echo $emailClass; ?>">
                  				<input type="email" class="form-control" id="emailvar" name="email" placeholder="Email" required>
                  				<span id="error-email" style="color:#d9534f;"></span>
                  			</div>
                  			<?php
                  			    if($errors["phone"])
                  			    {
                  			        $phoneClass = "has-error";
                  			    }
                  			?>
                  			<div class="form-group <?php echo $phoneClass; ?>">
                  				<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required>
                  				<span id="error-phone" style="color:#d9534f;"></span>
                  			</div>
                  			<?php
                  			    if($errors["password"])
                  			    {
                  			        $passwordClass = "has-error";
                  			    }
                  			?>
                  			<div class="form-group <?php echo $passwordClass; ?>">
                  			    <input type="password" name="password1" class="form-control" id="password1" placeholder="Password - min: 8 characteres" required>
                  			</div>
                  			<div class="form-group <?php echo $passwordClass; ?>">
                  			    <input type="password" name="password2" class="form-control" id="password2" placeholder="Retype your password" required>
                  			    <span id="error-password" style="color:#d9534f;"></span>
                  			</div>
                  			<div class="form-group">
                            <textarea class="form-control" type="textarea" id="user_request" name="user_request" placeholder="User Request (Optional)" maxlength="200" rows="7"></textarea>                   
                        </div>
                        <div class="text-center">
                            <button id="signUpBtn" onClick="checkSignUp()" type="submit" name="submit" value="register" class="btn btn-danger">Sign Up</button>
                        </div>
                        <div id="success"></div>
                        </form>
                      </div>
                </div>
                <div class="col-md-6" id="booking-details">
                  <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <h4 class="text-center">Number of people:</h4>
                        <div class="input-group">
                          <input class="form-control" value="<?php echo $no_people; ?>" name="no_people" readonly>
                          <div class="input-group-addon">
                            <i class="fa fa-user" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                  </div>
                    <div class="row">
                      <div class="col-md-10 col-md-offset-1">
                        <h4 class="text-center">Date:</h4>
                        <div class="input-group">
                          <input class="form-control" value="<?php echo $date_picked;?>" name="date" readonly>
                          <div class="input-group-addon">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10 col-md-offset-1">
                        <h4 class="text-center">Time:</h4>
                        <div class="input-group">
                          <input class="form-control" name="time" value="<?php echo $time_picked; ?>" readonly>
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10 col-md-offset-1">
                        <h4 class="text-center">Table:</h4>
                        <div class="input-group">
                          <input class="form-control" id="table" name="table" readonly>
                          <div class="input-group-addon">
                            <i class="fa fa-square-o" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10 col-md-offset-1">
                        <h4 class="text-center">Booking request:</h4>
                          <textarea class="form-control" type="textarea" id="booking_request" name="booking_request" placeholder="Booking Request (Optional)" maxlength="200" rows="7" readonly><?php echo $booking_request; ?></textarea>                   
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10 col-md-offset-1 text-center">
                        <br>
                        <div id="success-msg"></div>
                        <button id="confirm-booking-button" type="submit" name="submit" value="confirm-booking" class="btn btn-danger" disabled>Confirm now!</button>
                      </div>
                    </div>
                </div>
            </div>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
$("#btn-login").click(function(){
  $("#content-login").show();
  $("#content-signup").hide();
  $('#chooseTableModal').modal('hide');
});

$("#btn-signup").click(function(){
  $("#content-signup").show();
  $("#content-login").hide();
  $('#chooseTableModal').modal('hide');
});

function checkBookingLogin() 
{
  document.getElementById("loginBookingButton").disabled = true;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) 
    {
        document.getElementById("loginBookingButton").disabled = false;
        
        if(this.responseText == "login-ok")
        {
            document.getElementById("success-msg").innerHTML = "<div class=\"alert alert-success fade in alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong><center><p class=\"text-center\">Logged in, Please confirm your booking!</p></center></strong></div>";
            document.getElementById("confirm-booking-button").disabled = false;
           
            $("#option-btns").hide();
            $("#content-login").hide();
            $("#left-col").hide();
           
            document.getElementById("booking-details").classList.remove("col-md-6");
            document.getElementById("booking-details").classList.add("col-md-12");
            
            //change size of modal
            document.getElementById("body-modal").classList.remove("modal-lg");
            document.getElementById("body-modal").classList.add("modal-md");
        }
        else
        {
            document.getElementById("booking-login").innerHTML = this.responseText;
        }
    }
  };
  var username = document.getElementById("booking-user"),
  password = document.getElementById("booking-password");
  xhttp.open("POST", "ajaxLogin.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("booking-user="+username.value+"&booking-password="+password.value);
}

//TODO TEM QUE TROCAR AS ID's pra nao dar conflito
//tive que mexer na parte do ajaxLogin.php pra pegar essas variaveis, tenta trocar so as IDs no Signup
//e nao os names. ai acho que nao vai precisar mexer no ajaxSignup.php
/*
function checkSignUp()
{
  document.getElementById("signUpBtn").disabled = true;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("signUpBtn").disabled = false;
        if(this.responseText == "signup-ok")
        {
            document.getElementById("signUpBtn").disabled = false;
            document.getElementById("success").innerHTML = "<div class=\"alert alert-success fade in alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong><center><p class=\"text-center\">Successfully registered!</p></center></strong></div><center><p class=\"text-center\">Would you like to login now?<a href=\"#\" data-toggle=\"modal\" data-target=\"#loginModal\" data-dismiss=\"modal\"><b>Login</b></a></p></center>";
        }
        else{
            var myObj = JSON.parse(this.responseText);
            if(myObj.firstName != null){
                document.getElementById("error-firstName").innerHTML = myObj.firstName;
            }
            if(myObj.lastName != null){
                document.getElementById("error-lastName").innerHTML = myObj.lastName;
            }
            if(myObj.email != null){
               document.getElementById("error-email").innerHTML = myObj.email; 
            }
            if(myObj.phone != null){
                document.getElementById("error-phone").innerHTML = myObj.phone;
            }
            if(myObj.password != null){
                document.getElementById("error-password").innerHTML = myObj.password;
            }
        }
    }
  };
  var title = document.getElementById("title"),
  firstName = document.getElementById("firstName"),
  lastName = document.getElementById("lastName"),
  emailvar = document.getElementById("emailvar"),
  phone = document.getElementById("phone"),
  password1 = document.getElementById("password1"),
  password2 = document.getElementById("password2"),
  user_request = document.getElementById("user_request");
  xhttp.open("POST", "ajaxSignUp.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("title="+title.value+"&firstName="+firstName.value+"&lastName="+lastName.value+"&emailvar="+emailvar.value+"&phone="+phone.value+"&password1="+password1.value+"&password2="+password2.value+"&user_request="+user_request.value);
}
*/
</script>
