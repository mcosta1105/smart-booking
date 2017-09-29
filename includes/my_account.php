<?php
    session_start();
    include("includes/my_account_booking_management.php");
    
    if(isset($_SESSION["phone"]))
    {
        
        $myAcc_userPhone = $_SESSION["phone"];
        $myAcc_userQuery =  "SELECT * FROM user WHERE phone=?";
        
        $myAcc_bookingQuery = "SELECT * FROM booking 
        INNER JOIN user ON booking.user_id = user.phone
        WHERE user.phone = ?
        GROUP BY user.phone
        ORDER BY booking.date";
        
        
        $connection = mysqli_connect(getenv("dbhost"),getenv("dbuser"),getenv("dbpass"),
            getenv("dbname"));
            
        //User tab     
        $userAcc_statement = $connection->prepare($myAcc_userQuery);
        $userAcc_statement->bind_param("s", $myAcc_userPhone);
        $userAcc_statement->execute();
        $myAcc_result = $userAcc_statement->get_result();
        //Bookings tab
        $bookingAcc_statement = $connection->prepare($myAcc_bookingQuery);
        $bookingAcc_statement->bind_param("s",$myAcc_userPhone);
        $bookingAcc_statement->execute();
        $bookingAcc_result = $bookingAcc_statement->get_result();
        
            
        while($myAcc_row = mysqli_fetch_array($myAcc_result))  
        {
            
            $first_name = $myAcc_row["first_name"];
            $last_name = $myAcc_row["last_name"];
            $email = $myAcc_row["email"];
            $phone = $myAcc_row["phone"];
            $user_req = $myAcc_row["user_request"];
            
            $title1 = "Mr.";
            $title2 = "Mrs.";
            $title3 = "Miss";
            
            //Verify Title
            if($myAcc_row["title"] == "Mr.")
            {
                $title1 = "Mr.";
                //$title2 = "Mrs.";
                //$title3 = "Miss";
            }
            else if($myAcc_row["title"] == "Mrs.")
            {
                $title1 = "Mrs.";
                //$title2 = "Mr.";
                //$title3 = "Miss";
            }
            else
            {
                $title1 = "Miss.";
                $title2 = "Mr.";
                $title3 = "Mrs.";
            }
        }
        
    }
?>
<!-- Modal My Account -->
<div id="myAccountModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" id="Account">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title title-red">My Account</h3>
        </div>
        <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs nav-justified">
                            <li role="presentation" class="active"><a class="redText" data-toggle="tab" href="#profile">Profile</a></li>
                            <li role="presentation"><a class="redText" data-toggle="tab" href="#bookings">Bookings</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content">
                            <div id="profile" class="tab-pane fade in active">
                                <div class="panel panel-danger">
                                    <div class="panel-heading">
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <select class="form-control" id="#">
                                                                <option><?php echo $title1; ?></option>
                                                                <option><?php echo $title2; ?></option>
                                                                <option><?php echo $title2; ?></option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $first_name; ?>" placeholder="First Name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                	<input type="text" class="form-control" id="lastName" name="lasttName" value="<?php echo $last_name; ?>" placeholder="Last Name" required>
                                                </div>
                                                <div class="form-group">
                                                	<input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" placeholder="Email" readonly>
                                                </div>
                                                <div class="form-group">
                                                	<input type="text" class="form-control" id="user-phone" name="phone" placeholder="Phone" value = "<?php echo $phone; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" type="textarea" id="message"  placeholder="User Request (Optional)" maxlength="200" rows="7"><?php echo $user_req; ?></textarea>                   
                                                </div>
                                                <div class="text-center"> 
                                                <div class="text-center" id="success-delete"></div>
                                                    <button id="delete-btn" onClick="processDelete()" type="button" class="btn btn-danger">Delete</button>
                                                    <button id="update-btn" onClick="updateUser" type="button" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="bookings" class="tab-pane fade">
                                <div class="panel panel-danger">
                                    <div class="panel-heading">
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="my_bookings_data">
                                                        <thead>
                                                            <tr>
                                                                <th>Phone</th>
                                                                <th>Date</th>
                                                                <th>Time</th>
                                                                <th>People</th>
                                                                <th>Table</th>
                                                                <th>Status</th>
                                                            </tr>
                                                            <tbody>
                                                                <?php 
                                                                    if(!$bookingAcc_result == null)
                                                                    {
                                                                        while($booking_row = mysqli_fetch_array($bookingAcc_result))
                                                                        {
                                                                            //Not Seated = 1
                                                                            //Seated = 2
                                                                            //Finished = 3
                                                                            //Canceled = 4
                                                                        
                                                                            if($booking_row['status'] == 1)
                                                                            {
                                                                                $status = "Not Seated";
                                                                            }
                                                                            else if($booking_row['status'] == 2)
                                                                            {
                                                                                $status = "Seated";
                                                                            }
                                                                            else if($booking_row['status'] == 3)
                                                                            {
                                                                                $status = "Finished";
                                                                            }
                                                                            else if($booking_row['status'] == 4)
                                                                            {
                                                                                $status = "Canceled";
                                                                            }
                                                                            echo'
                                                                                <tr id="'.$booking_row['id'].'">
                                                                                    <td>'.$booking_row['phone'].'</td>
                                                                                    <td>'.$booking_row['date'].'</td>
                                                                                    <td>'.$booking_row['time'].'</td>
                                                                                    <td>'.$booking_row['no_people'].'</td>
                                                                                    <td>'.$booking_row['table_id'].'</td>
                                                                                    <td>'.$status.'</td>
                                                                                </tr>
                                                                                ';
                                                                        }
                                                                    }
                                                                ?>
                                                            </tbody>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="text-center"> 
                                                <button data-toggle="modal" data-target="#myAccountBookingManagementModal" data-dismiss="modal" type="button" class="btn btn-danger">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){  
      $('#my_bookings_data').DataTable(); 
      
    });  
    
    
    //Delete function
    function processDelete()
    {
        document.getElementById("delete-btn").style.visibility = "hidden";
        document.getElementById("update-btn").style.visibility = "hidden";
        document.getElementById("success-delete").innerHTML = "<div class=\"alert alert-danger fade in alert-dismissible\" role=\"alert\"><strong>Are you sure you want to delete your account?<button id=\"confirm\" onClick=\"confirm()\" class=\"btn btn-danger\" style=\"margin-left:10px\">Yes</button><button id=\"confirm\" onClick=\"notConfirmed()\" class=\"btn btn-primary\" style=\"margin-left:10px\">No</button></strong></div>";
    }
 
    function confirm(){
        var deletexhttp = new XMLHttpRequest();
        deletexhttp.onreadystatechange = function()
        {
            if(this.readyState == 4 && this.status == 200)
            {
                 if(this.responseText == "delete-ok")
                 {
                    document.getElementById("success-delete").innerHTML = "<div class=\"alert alert-success fade in alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong>Sucessfully deleted!</strong></div>";
                    //reload screen when close modal
                     $('#profileModal').on('hidden.bs.modal', function () {
                        location.reload();
                     });
                }
                else
                {
                    document.getElementById("success-delete").innerHTML = "<div class=\"alert alert-warning fade in alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong>Not Deleted, Error!</strong></div>";    
                    document.getElementById("delete-btn").style.visibility = "visible";
                    document.getElementById("update-btn").style.visibility = "visible";
                    
                }
            }
        };
        var phone = document.getElementById("user-phone");
        deletexhttp.open("POST", "includes/deleteUser.php", true);
        deletexhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        deletexhttp.send("phone="+phone.value);
        console.log(phone);
    }
    
    function notConfirmed(){
        document.getElementById("success-delete").innerHTML ="";
        document.getElementById("delete-btn").style.visibility = "visible";
        document.getElementById("update-btn").style.visibility = "visible";
    }
    
    function updateUser(){
        document.getElementById("update-btn").disabled = true;
        var updatexhttp = new XMLHttpRequest();
        updatexhttp.onreadystatechange = function()
        {
             
            if(this.readyState == 4 && this.status == 200)
            {
                document.getElementById("update-btn").disabled = false;
                if(this.responseText == "update-ok")
                { 
                    document.getElementById("success-update").innerHTML = "<div class=\"alert alert-success fade in alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong>Successfully Updated!</strong></div>";
                    //reload screen when close modal
                    $('#profileModal').on('hidden.bs.modal', function () {
                        location.reload();
                    });
                 }
                 else
                 {
                    var myUpdateObj = JSON.parse(this.responseText);
                    if(myUpdateObj.firstName != null)
                    {
                        document.getElementById("error-update-firstName").innerHTML = myUpdateObj.firstName;
                    }
                    if(myUpdateObj.lastName != null)
                    {
                        document.getElementById("error-update-lastName").innerHTML = myUpdateObj.lastName;
                    }
                }
            }
        };
        var title = document.getElementById("title"),
        firstName = document.getElementById("firstName"),
        lastName = document.getElementById("lastName"),
        email = document.getElementById("email"),
        phone = document.getElementById("phone"),
        user_request = document.getElementById("user_request"),
        level = document.getElementById("level"),
        status = document.getElementById("status");
        updatexhttp.open("POST","ajaxUpdate.php",true);
        updatexhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        updatexhttp.send("title="+title.value+"&firstName="+firstName.value+"&lastName="+lastName.value+"&phone="+phone.value+"&user_request="+user_request.value+"&level="+level.value+"&status="+status.value);
    }
    
</script>

