<?php
    session_start();

    if(isset($_POST["phone"]) && !$_POST["submit"] == "delete" && !$_POST["submit"] == "update")
    {
        $user_phone = $_POST["phone"];
        $user_query =  "SELECT * FROM user WHERE phone=?";
        
        $connection = mysqli_connect(getenv("dbhost"),getenv("dbuser"),getenv("dbpass"),
            getenv("dbname"));
            
        $statement = $connection->prepare($user_query);
        $statement->bind_param("s", $user_phone);
        $statement->execute();
        $result = $statement->get_result();

        while($row = mysqli_fetch_array($result))  
        {
            $title1 = "Mr.";
            $title2 = "Mrs.";
            $title3 = "Miss";
            
            //Level
            if($row["level"] == 1)
            {
                $userLevel1 = "User";
                $userLevel2 = "Admin";
            }
            else
            {
                $userLevel1 = "Admin";
                $userLevel2 = "User";
            }
            
            //Status
            if($row["user_status"] == 1)
            {
                $userStatus1 = "Active";
                $userStatus2 = "Inactive";
            }
            else
            {
                $userStatus1 = "Inactive";
                $userStatus2 = "Active";
            }
        
            //Verify Title
            if($row["title"] == "Mr.")
            {
                $title1 = "Mr.";
                $title2 = "Mrs.";
                $title3 = "Miss";
            }
            else if($row["title"] == "Mrs.")
            {
                $title1 = "Mrs.";
                $title2 = "Mr.";
                $title3 = "Miss";
            }
            else
            {
                $title1 = "Miss.";
                $title2 = "Mr.";
                $title3 = "Mrs.";
            }
        $output .= '
            <div class="form-group">
            <div class="row">
                    <div class="col-md-4">
                        <select class="form-control" id="title" name="title">
		                    <option>'.$title1.'</option>
		                    <option>'.$title2.'</option>
		                    <option>'.$title3.'</option>
	                    </select>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="firstName" name="firstName" value = "'.$row["first_name"].'" placeholder="First Name" required>
                    </div>
                </div>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" value = "'.$row["last_name"].'">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="email" name="email" placeholder="Email" value = "'.$row["email"].'" required readonly>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value = "'.$row["phone"].'" required readonly>
			</div>
			<div class="form-group">
                <textarea class="form-control" type="textarea" id="user_request" name="user_request" placeholder="User Request (Optional)" maxlength="200" rows="7">'.$row["user_request"].'</textarea>                   
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <select class="form-control" id="level" name="level">
		                    <option>'.$userLevel1.'</option>
		                    <option>'.$userLevel2.'</option>
	                    </select>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control" id="status" name="status">
		                    <option>'.$userStatus1.'</option>
		                    <option>'.$userStatus2.'</option>
	                    </select>
                    </div>
                </div>
			</div>
			';
        }     
        echo $output;
    }
    
?>
