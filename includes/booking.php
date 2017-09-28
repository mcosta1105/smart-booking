<?php
  session_start();
  $currentpage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
  
  //Process Booking
  if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] == "booking")
  {
      $no_people = $_POST["no_people"];
      $date_picked = $_POST["date"];
      $time_picked = $_POST["time"];
      $booking_request = $_POST["booking_request"];
      
      
      /*$booking_result = true;
      
      if($booking_result)
      {
         //GUEST UNTIL LOGIN
        $user_changed = "0000";
        
        //STATUS = 0, pending confirmation
        $booking_status = 0;
        
        //table_id = 0, pending choose table
        $table_no = 0;
        
        $booking_query = "INSERT INTO booking (date, time,no_people,date_created,date_alter,user_changed,booking_request,status,user_id,table_id)
                          VALUES('$date_picked', '$time_picked', '$no_people',NOW(),NOW(), '$user_changed','$booking_request','$booking_status', '$user_changed','$table_no')";
        
        $booking_statement = $connection->prepare($booking_query);
        $booking_result = $booking_statement->execute();
      }
      */
      
      //Pending = 0
      //Not Seated = 1
      //Seated = 2
      //Finished = 3
      //Canceled = 4
      
      //FIND BOOKINGS OF THAT DAY AND TIME
      $query = "SELECT b.date, b.time, b.no_people, b.status, b.table_id 
                FROM booking b
                WHERE b.date = ?
                AND b.time = ?
                AND (b.status = 0 OR b.status = 1 OR b.status = 2)";
                
                
      //FIND TABLES ACCORDING TO NUMBER OF PEOPLE                
      $tables_query = "SELECT * FROM restaurant_tables WHERE seats = ?";
      
      //FIND TABLE AVAILABLE ACCORDING WITH DATE AND TIME
      $tables_available = "SELECT t.id FROM restaurant_tables t
                            WHERE t.seats >= ?
                            AND NOT t.id IN
                            (SELECT b.table_id FROM booking b
                            WHERE b.date = ?
                            AND b.time = ?
                            AND (b.status = 0 OR b.status = 1 OR b.status = 2)
                            GROUP BY b.table_id)";
      
      //Remove PM from time
      $time_picked = str_replace("PM", "",$time_picked);
      
      $statement = $connection->prepare($tables_available);
      $statement->bind_param("sss",$no_people,$date_picked, $time_picked);
      $statement->execute();
      
      $booking_result = $statement->get_result();
      
      //Push into Array
      if($booking_result->num_rows > 0)
      {
        $tables_available_array = array();
        
        while($row = $booking_result->fetch_assoc())
        {
            array_push($tables_available_array, $row["id"]);
        }
      }
      
      $tableN01 = 1;
      $tableN02 = 2;
      $tableN03 = 3;
      $tableN04 = 4;
      $tableN05 = 5;
      $tableN06 = 6;
      $tableN07 = 7;
      $tableN08 = 8;
      $tableN09 = 9;
      $tableN10 = 10;

      $tableN01Status = "table-booked";
      $tableN02Status = "table-booked";
      $tableN03Status = "table-booked";
      $tableN04Status = "table-booked";
      $tableN05Status = "table-booked";
      $tableN06Status = "table-booked";
      $tableN07Status = "table-booked";
      $tableN08Status = "table-booked";
      $tableN09Status = "table-booked";
      $tableN10Status = "table-booked";
      
      if(count($tables_available_array) > 0)
      {
        foreach($tables_available_array as $table)
        {
          if($table == $tableN01)
          {
            $tableN01Status = "table-available";
          }
          else if($table == $tableN02)
          {
            $tableN02Status = "table-available";
          }
          else if($table == $tableN03)
          {
            $tableN03Status = "table-available";
          }
          else if($table == $tableN04)
          {
            $tableN04Status = "table-available";
          }
          else if($table == $tableN05)
          {
            $tableN05Status = "table-available";
          }
          else if($table == $tableN06)
          {
            $tableN06Status = "table-available";
          }
          else if($table == $tableN07)
          {
            $tableN07Status = "table-available";
          }
          else if($table == $tableN08)
          {
            $tableN08Status = "table-available";
          }
          else if($table == $tableN09)
          {
            $tableN09Status = "table-available";
          }
          else if($table == $tableN10)
          {
            $tableN10Status = "table-available";
          }
          else
          {
            $tableN01Status = "table-booked";
            $tableN02Status = "table-booked";
            $tableN03Status = "table-booked";
            $tableN04Status = "table-booked";
            $tableN05Status = "table-booked";
            $tableN06Status = "table-booked";
            $tableN07Status = "table-booked";
            $tableN08Status = "table-booked";
            $tableN09Status = "table-booked";
            $tableN10Status = "table-booked";
          }
          
        }
      }
      
     
      
      ?>
      
      <script type="text/javascript"> 
       $(document).ready(function(){
           //TODO $('#bookingModal').modal('show'); DONT CLOSE MODAL
           $('#chooseTableModal').modal('show');
       });
      </script>
    <?php
  }
?>

<!-- Booking Modal -->

<div id="bookingModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title title-red">Booking</h3>
      </div>
      <div class="modal-body">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <form id="booking-form" action= "<?php echo $currentpage; ?>" method="post">
                  <h4 class="text-center">Number of people:</h4>
                  <div class="input-group">
                    <select class="form-control" id="#" name="no_people">
  		                <option>01</option>
  		                <option>02</option>
  		                <option>03</option>
  		                <option>04</option>
  		                <option>05</option>
  		                <option>06</option>
  		              </select>
                    <div class="input-group-addon">
                      <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <h4 class="text-center">Select a date:</h4>
                  <div class="input-group date" data-provide="datepicker">
                    <input type="date" value="<?php echo date('Y-m-d');?>" class="form-control" name="date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
               
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <h4 class="text-center">Select a time:</h4>
                  <div class="input-group">
                    <select class="form-control" id="#" name="time">
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
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <h4 class="text-center">Booking request:</h4>
                    <textarea class="form-control" type="textarea" id="booking_request" name="booking_request" placeholder="Booking Request (Optional)" maxlength="200" rows="7"></textarea>                   
                </div>
              </div>
              
              <div class="row">
                  <div class="text-center" style="margin-top:5%">
                    <button type="submit" name="submit" value="booking" class="btn btn-danger">Choose a Table</button>
                  </div>  
              </div>
            </form>
      </div>
    </div>
  </div>
</div>
<?php
    include("includes/chooseTable.php");
?>