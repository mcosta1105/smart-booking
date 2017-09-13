<?php
  session_start();
  $currentpage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
  
  //Process Booking
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
      $no_people = $_POST["no_people"];
      $date_picked = $_POST["date"];
      $time_picked = $_POST["time"];
      
      //Not Seated = 1
      //Seated = 2
      //Finished = 3
      //Canceled = 4
      
      //FIND BOOKINGS OF THAT DAY AND TIME
      $query = "SELECT b.date, b.time, b.no_people, b.status, b.table_id 
                FROM booking b
                WHERE b.date = ?
                AND b.time = ?
                AND (b.status = 1 OR b.status = 2)";
                
                
      //FIND TABLES ACCORDING TO NUMBER OF PEOPLE                
      $tables_query = "SELECT * FROM restaurant_tables WHERE seats = ?";
      
      //FIND TABLE AVAILABLE ACCORDING WITH DATE AND TIME
      $tables_available = "SELECT t.id FROM restaurant_tables t
                            WHERE t.seats >= ?
                            AND NOT t.id IN
                            (SELECT b.table_id FROM booking b
                            WHERE b.date = ?
                            AND b.time = ?
                            AND (b.status = 1 OR b.status = 2)
                            GROUP BY b.table_id)";
      
      //Remove PM from time
      $time_picked = str_replace("PM", "",$time_picked);
      
      $statement = $connection->prepare($tables_available);
      $statement->bind_param("sss",$no_people,$date_picked, $time_picked);
      $statement->execute();
      
      $result = $statement->get_result();
      
      //Push into Array
      if($result->num_rows > 0)
      {
        $tables_array = array();
        
        while($row = $result->fetch_assoc())
        {
            array_push($tables_array, $row);
        }
      }
      
      /*foreach($tables_array as $table)
      {
        $tableNo = $table["id"];
        //echo $tableNo;
      }
      */
      
      if(count($tables_array) > 0)
      {
        foreach($tables_array as $table)
        {
          if($table["id"] == 5)
          {
            $tableStatus = "cursor:not-allowed";
          }
        }
      }
      
      
    
      
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
  		                <option>07</option>
  		                <option>08</option>
  		                <option>09</option>
  		                <option>10</option>
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
                    <input type="date" class="form-control" name="date">
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
                  <div class="text-center" style="margin-top:5%">
                    <button type="submit"  value="booking" data-toggle="modal" data-target="#chooseTableModal"  class="btn btn-danger">Choose a Table</button>
                  </div>  
                </div>
              </form>
      </div>
    </div>
  </div>
</div>

<?php

// btn = data-toggle="modal" data-target="#chooseTableModal"  data-dismiss="modal"
    include("includes/chooseTable.php");
?>
