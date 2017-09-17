<?php
    session_start();

    if(isset($_POST["id"]))
    {
        $user_id = $_POST["id"];
        $user_query =  "SELECT * FROM user WHERE id=?";
        
        $connection = mysqli_connect(getenv("dbhost"),getenv("dbuser"),getenv("dbpass"),
            getenv("dbname"));
            
        $statement = $connection->prepare($user_query);
        $statement->bind_param("i", $user_id);
        $statement->execute();
        $result = $statement->get_result();

        //$userSelectedData = $result->fetch_assoc();
        //$selectedname = $userSelectedData["first_name"];
        
        while($row = mysqli_fetch_array($result))  
        {
        
        $output .= '
            <div class="form-group">
            <div class="row">
                    <div class="col-md-2">
                        <select class="form-control" id="#"disabled>
		                    <option>Mr.</option>
		                    <option>Mrs.</option>
		                    <option>Miss.</option>
	                    </select>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="firstName" name="firstName" value = "'.$row["first_name"].'" placeholder="First Name">
                    </div>
                </div>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="lastName" name="lasttName" placeholder="Last Name" required disabled>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="email" name="email" placeholder="Email" required disabled>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required disabled>
			</div>
			<div class="form-group">
                <textarea class="form-control" type="textarea" id="message" placeholder="Special Request (Optional)" maxlength="200" rows="7" disabled></textarea>                   
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <select class="form-control" id="#" disabled>
		                    <option>User</option>
		                    <option>Administrator</option>
	                    </select>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center"> 
                            <button type="button" class="btn btn-primary" data-dismiss="modal"> Edit </button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
			</div>
			';
        }     
        echo $output;
    }
    
?>
