<!-- Modal -->
<div id="bookingManagementModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title title-blue">Booking Management</h3>
        </div>
        <div class="modal-body">
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
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required disabled>
                    </div>
                </div>
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
			            <input type="date" class="form-control" id="date" name="date_time" placeholder="Date/Time" required disabled>  
			        </div>
			        <div class="col-md-6">
			            <select class="form-control" id="#" disabled>
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
                        <select class="form-control" id="#" disabled>
    	                    <option>People</option>
    	                    <option>1</option>
    	                    <option>2</option>
    	                    <option>3</option>
    	                    <option>4</option>
    	                    <option>5</option>
    	                    <option>6</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" id="#" disabled>
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
                        <select class="form-control" id="#" disabled>
    	                    <option>Status</option>
    	                    <option>Canceled</option>
    	                    <option>Finished</option>
    	                    <option>Not Seated</option>
    	                    <option>Seated</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <button type="button" class="btn btn-primary" data-dismiss="modal"> Edit </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Delete</button>                    
            </div>
        </div>
    </div>
  </div>
</div>