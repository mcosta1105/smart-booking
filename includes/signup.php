<!-- Sign Up -->

<!--Script to align modal popup vertically-->


<!-- Modal -->
<div id="signUpModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title title-red">Sign Up</h3>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2">
                        <select class="form-control" id="#">
		                    <option>Mr.</option>
		                    <option>Mrs.</option>
		                    <option>Miss.</option>
	                    </select>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
                    </div>
                </div>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="lastName" name="lasttName" placeholder="Last Name" required>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required>
			</div>
			<div class="form-group">
                <textarea class="form-control" type="textarea" id="message" placeholder="Special Request (Optional)" maxlength="200" rows="7"></textarea>                   
            </div>
            <div class="text-center"> 
                <button type="button" class="btn btn-danger" data-dismiss="modal">Sign Up</button>
            </div>
        </div>
    </div>
  </div>
</div>