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
  <div class="modal-dialog modal-sm">
<!-- Modal content-->
    <div class="modal-content">
      <form id="booking-confirmation-form" action= "<?php echo $currentpage; ?>" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title title-red">Booking</h3>
        <h3 class="modal-title title-red">Confirmation</h3>
      </div>
      <div class="modal-body">
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
      </div>
      <div class="modal-footer">
            <div class="text-center" id="success-confirm">
                
            </div>
            <div class="text-center" style="margin-top:5%">
                <button type="submit" name="submit" value="confirm-booking" class="btn btn-danger">Confirm now!</button>
            </div>  
      </div>
      </form>
    </div>
  </div>
</div>
