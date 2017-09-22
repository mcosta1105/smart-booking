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
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Table</th>
                                    <th>Person(s)</th>
                                    <th>Status</th>
                                    <th>Title</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Booking Request</th>
                                    <th>User Request</th>
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
                                                <tr id="'.$row['id'].'">
                                                    <td>'.$row['id'].'</td>
                                                    <td>'.$row['date'].'</td>
                                                    <td>'.$row['time'].'</td>
                                                    <td>'.$row['table_id'].'</td>
                                                    <td>'.$row['no_people'].'</td>
                                                    <td>'.$status.'</td>
                                                    <td>'.$row['title'].'</td>
                                                    <td>'.$row['first_name'].'</td>
                                                    <td>'.$row['phone'].'</td>
                                                    <td>'.$row['booking_request'].'</td>
                                                    <td>'.$row['user_request'].'</td>
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

<!-- Modal -->
<div id="bookingManagementModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title title-blue">Booking Management</h3>
        </div>
        <div class="modal-body" id="booking_detail">
            
        </div>
            <div class="form-group text-center">
                <button type="submit" name="submit" value="delete" class="btn btn-danger">Delete</button>
                    <button type="submit" name="submit" value="update" class="btn btn-primary">Update</button>              
            </div>
        </div>
    </div>
</div>
<script>
 $(document).ready(function(){  
      $('#bookings_data').DataTable(); 
      $('#bookings_data tbody').on( 'click', 'tr', function () {
    var id = $(this).attr("id");
    console.log(id);
    $.ajax({  
                url:"includes/booking_management.php",  
                method:"post",  
                data:{id:id},  
                success:function(data){  
                     $('#booking_detail').html(data);  
                     $('#bookingManagementModal').modal("show");  
                }  
           });  
      });
 });  
</script>