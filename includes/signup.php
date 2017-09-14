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
                        <select class="form-control" id="#" name="title">
		                    <option>Mr.</option>
		                    <option>Mrs.</option>
		                    <option>Miss.</option>
	                    </select>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" value="<?php echo $firstName; ?>" required>
                        <span class="help-block">
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
				<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
				<span class="help-block"><?php echo $errors["email"]; ?></span>
			</div>
			<?php
			    if($errors["phone"])
			    {
			        $phoneClass = "has-error";
			    }
			?>
			<div class="form-group <?php echo $phoneClass; ?>">
				<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required>
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
			    <span class="help-block"><?php echo $errors["password"]; ?></span>
			</div>
			<div class="form-group">
                <textarea class="form-control" type="textarea" id="message" name="message" placeholder="Special Request (Optional)" maxlength="200" rows="7"></textarea>                   
            </div>
            <div class="text-center"> 
                <button type="submit" name="submit" value="register" class="btn btn-danger">Sign Up</button>
            </div>
        </form>
        </div>
    </div>
  </div>
</div>