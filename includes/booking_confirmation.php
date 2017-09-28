
<!-- Booking Confirmation Modal -->
<div id="bookingConfirmationModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title title-red">Booking</h3>
        <h3 class="modal-title title-red">Confirmation</h3>
      </div>
      <div class="modal-body">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <form id="booking-confirmation-form" action= "<?php echo $currentpage; ?>" method="post">
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
            </form>
      </div>
      <div class="modal-footer">
            <div class="text-center" id="success-confirm">
                
            </div>
            <div class="text-center" style="margin-top:5%">
                <button type="submit" name="submit" value="confirm-booking" class="btn btn-danger">Confirm now!</button>
            </div>  
      </div>
    </div>
  </div>
</div>
<?php

  session_start();
  //TODO UPDATE BOOKING
  /*
  if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] == "booking")
  {
    //GUEST UNTIL LOGIN
    $user_changed = "0000";
    
    //STATUS = 0, pending confirmation
    $booking_status = 0;
    
    $booking_query = "INSERT INTO booking (date, time,no_people,date_created,date_alter,user_changed,booking_request,status,user_id,table_id)
                      VALUES('$date_picked', '$time_picked', '$no_people',NOW(),NOW(), '$user_changed','$booking_request','$booking_status', '$user_changed','$table_no')";
    
    $booking_statement = $connection->prepare($booking_query);
    $booking_result = $booking_statement->execute();
  }  */
  
?>