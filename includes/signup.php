
<!-- Modal -->
<div id="signUpModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title title-red">Sign Up</h3>
        </div>
        <div class="modal-body">
        <form id="register-form" action="<?php echo $currentpage; ?>" method="post">
            <?php
                if($errors["firstName"])
                {
                    $firstNameClass = "has-error";
                }
            ?>
            <div class="form-group <?php echo $firstNameClass; ?>">
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
                        <span class="help-block" id="error-name">
                            <?php echo $errors["firstName"]; ?>
                        </span>
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
			    <span class="help-block"><?php echo $errors["lastName"]; ?></span>
			</div>
			<?php
			    if($errors["email"])
			    {
			        $emailClass = "has-error";
			    }
			?>
			<div class="form-group <?php echo $emailClass; ?>">
				<input type="email" class="form-control" id="emailvar" name="email" placeholder="Email" required>
				<span class="help-block" id="error-email"><?php echo $errors["email"]; ?></span>
			</div>
			<?php
			    if($errors["phone"])
			    {
			        $phoneClass = "has-error";
			    }
			?>
			<div class="form-group <?php echo $phoneClass; ?>">
				<input type="text" class="form-control" id="error-phone" name="phone" placeholder="Phone" required>
				<span class="help-block"><?php echo $errors["phone"]; ?></span>
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
			    <span id="error-password" class="help-block"><?php echo $errors["password"]; ?></span>
			</div>
			<div class="form-group">
                <textarea class="form-control" type="textarea" id="specialrequest" name="message" placeholder="Special Request (Optional)" maxlength="200" rows="7"></textarea>                   
            </div>
            <div class="text-center"> 
                <button id="signUpBtn" onclick="checkSignUp()" type="submit" name="submit" value="register" class="btn btn-danger">Sign Up</button>
            </div>
            <div id="signup"></div>
        </form>
        </div>
    </div>
  </div>
</div>

<script>
    function checkSignUp(){
        document.getElementById("signUpBtn").disabled = true;
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("signUpBtn").disabled = false;
            if(this.responseText == "signup-ok"){
                window.location.reload();
            }
            else{
                var myObj = JSON.parse(this.responseText);
                document.getElementById("signup").innerHTML = this.responseText;
                document.getElementById("error-phone") = myObj.phone;
                alert(myObj.phone);
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
      specialrequest = document.getElementById("specialrequest");
      xhttp.open("POST", "ajaxSignUp.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("title="+title.value+"&firstName="+firstName.value+"&lastName="+lastName.value+"&emailvar="+emailvar.value+"&phone="+phone.value+"&password1="+password1.value+"&password2="+password2.value+"&specialrequest="+specialrequest.value);
    }
</script>