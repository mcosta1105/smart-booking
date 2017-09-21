<?php
    session_start();
    
    if(isset($_POST["id"])){
        
        $booking_id = $_POST["id"];
        $booking_query = "SELECT * FROM booking 
        INNER JOIN user ON booking.user_id = user.phone
        WHERE booking.id = ?
        GROUP BY user.phone";
        
        $connection = mysqli_connect(getenv("dbhost"),getenv("dbuser"),getenv("dbpass"),
            getenv("dbname"));
            
        $statement_booking = $connection->prepare($booking_query);
        $statement_booking->bind_param("s", $booking_id);
        $statement_booking->execute();
        $result_booking = $statement_booking->get_result();
        
        while($row_booking = mysqli_fetch_array($result_booking))  
        {
            $title1 = "Mr.";
            $title2 = "Mrs.";
            $title3 = "Miss";
            
            
            //Verify Title
            if($row_booking["title"] == "Mr.")
            {
                $title1 = "Mr.";
                $title2 = "Mrs.";
                $title3 = "Miss";
            }
            else if($row_booking["title"] == "Mrs.")
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
            
            //status
            if($row_booking["status"] == 1)
            {
                $status1 = "Not Seated";
                $status2 = "Seated";
                $status3 = "Finished";
                $status4 = "Canceled";
            }
            else if($row_booking["status"] == 2)
            {
                $status1 = "Seated";
                $status2 = "Not Seated";
                $status3 = "Finished";
                $status4 = "Canceled";
            }
            else if($row_booking["status"] == 3)
            {
                $status1 = "Finished";
                $status2 = "Not Seated";
                $status3 = "Seated";
                $status4 = "Canceled";
            }
            else{
                $status1 = "Canceled";
                $status2 = "Not Seated";
                $status3 = "Seated";
                $status4 = "Finished";
            }
            
            $output_booking .='
                <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-control" id="#"disabled>
		                    <option>'.$title1.'</option>
		                    <option>'.$title2.'</option>
		                    <option>'.$title3.'</option>
	                    </select>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="firstName" name="firstName" value="'.$row_booking['first_name'].'" placeholder="First Name" required readonly>
                    </div>
                </div>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="phone" name="phone" value="'.$row_booking['phone'].'"placeholder="Phone" required readonly>
			</div>
			<div class="form-group">
                <textarea class="form-control" type="textarea" id="message"  placeholder="Special Request (Optional)" maxlength="200" rows="7" >'.$row_booking['special_request'].'</textarea>                   
            </div>
			<div class="form-group">
			    <div class="row">
			        <div class="col-md-6">
			            <input type="date" class="form-control" id="date" name="date_time" value="'.$row_booking['date'].'" placeholder="Date/Time" required >  
			        </div>
			        <div class="col-md-6">
			            <select class="form-control" id="#">
			                <option>'.$row_booking['time'].'</option>
    	                    <option>5:00 PM</option>
      		                <option>5:30 PM</option>
      		                <option>6:00 PM</option>
      		                <option>6:30 PM</option>
      		                <option>7:00 PM</option>
      		                <option>7:30 PM</option>
      		                <option>8:00 PM</option>
      		                <option>8:30 PM</option>
      		                <option>9:00 PM</option>
      		                <option>9:30 PM</option>
      		                <option>10:00 PM</option>
                        </select>
			        </div>
			    </div>
			</div>
			
			<div class="form-group">
			    <div class="row">
                    <div class="col-md-4">
                        <select class="form-control" id="#">
    	                    <option>Person(s): '.$row_booking['no_people'].'</option>
    	                    <option>Person(s): 1</option>
    	                    <option>Person(s): 2</option>
    	                    <option>Person(s): 3</option>
    	                    <option>Person(s): 4</option>
    	                    <option>Person(s): 5</option>
    	                    <option>Person(s): 6</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" id="#">
                            <option>Table '.$row_booking['table_id'].'</option>
                            <option>Table 1</option>
    	                    <option>Table 2</option>
    	                    <option>Table 3</option>
    	                    <option>Table 4</option>
    	                    <option>Table 5</option>
    	                    <option>Table 6</option>
    	                    <option>Table 7</option>
    	                    <option>Table 8</option>
    	                    <option>Table 9</option>
    	                    <option>Table 10 </option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" id="#">
    	                    <option>'.$status1.'</option>
    	                    <option>'.$status2.'</option>
    	                    <option>'.$status3.'</option>
    	                    <option>'.$status4.'</option>
                        </select>
                    </div>
                </div>
            </div>
            ';
        }
        echo $output_booking;
    }
?>
