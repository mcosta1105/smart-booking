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
                <h4 class="text-center">Number of people:</h4>
                <div class="input-group">
                  <select class="form-control" id="#">
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
                  <input type="date" class="form-control">
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
                  <select class="form-control" id="#">
		                <option>00:00</option>
		              </select>
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
            
              <div class="row">
                <div class="text-center" style="margin-top:5%">
                  <button data-toggle="modal" data-target="#chooseTableModal"  data-dismiss="modal" type="button" class="btn btn-danger">Choose a Table</button>
                </div>  
              </div>
      </div>
    </div>
  </div>
</div>

<?php
    include("includes/chooseTable.php");
?>
