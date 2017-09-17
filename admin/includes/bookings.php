<?php

    session_start();
    
    $currentpage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    include("includes/booking_management.php");
    
    date_default_timezone_set('Australia/Sydney');
    $currentDate = date('Y-m-d');
    
    $user_firstName = $_SESSION["user_firstName"];
    
    if($user_firstName != null OR $user_firstName != "")
    {
        $query  = "SELECT * FROM booking 
        INNER JOIN user ON booking.user_id = user.phone 
        GROUP BY user.phone
        ORDER BY booking.date";
    
        $booking_result = $connection->query($query);
    }
?>
<form action = "<?php echo $currentpage; ?>" method="post">
    <div class="panel panel-primary">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h4 class="text-center">Bookings List</h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered" id="bookings_data">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Table</th>
                                    <th>People</th>
                                    <th>Status</th>
                                    <th>Title</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Special Request</th>
                                </tr>
                                <tbody>
                                    <?php 
                                        if(!$booking_result == null)
                                        {
                                            while($row = mysqli_fetch_array($booking_result))
                                            {
                                                //Not Seated = 1
                                                //Seated = 2
                                                //Finished = 3
                                                //Canceled = 4
                                            
                                                if($row['status'] == 1)
                                                {
                                                    $status = "Not Seated";
                                                }
                                                else if($row['status'] == 2)
                                                {
                                                    $status = "Seated";
                                                }
                                                else if($row['status'] == 3)
                                                {
                                                    $status = "Finished";
                                                }
                                                else if($row['status'] == 4)
                                                {
                                                    $status = "Canceled";
                                                }
                                                echo'
                                                <tr>
                                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a>'.$row['date'].'</td>
                                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a>'.$row['time'].'</td>
                                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a>'.$row['table_id'].'</td>
                                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a>'.$row['no_people'].'</td>
                                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a>'.$status.'</td>
                                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a>'.$row['title'].'</td>
                                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a>'.$row['first_name'].'</td>
                                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a>'.$row['phone'].'</td>
                                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a>'.$row['special_request'].'</td>
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
            </div>
        </div>
    </div>
</form>
<script>
 $(document).ready(function(){  
      $('#bookings_data').DataTable();  
 });  
</script>