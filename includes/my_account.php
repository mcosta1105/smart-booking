<?php
    include("includes/my_account_booking_management.php");
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
                                                                <option>Mr.</option>
                                                                <option>Mrs.</option>
                                                                <option>Miss.</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-9">
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
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Edit</button>
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
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Phone</th>
                                                                <th>Date/Time</th>
                                                                <th>People</th>
                                                                <th>Table</th>
                                                                <th>Status</th>
                                                            </tr>
                                                            <tbody>
                                                                <tr class="danger">
                                                                    <td>1</td>
                                                                    <td>0405002255</td>
                                                                    <td>31/08/2017 - 20:30</td>
                                                                    <td>4</td>
                                                                    <td>5</td>
                                                                    <td>Not Seated</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>0405002255</td>
                                                                    <td>31/08/2017 - 20:30</td>
                                                                    <td>4</td>
                                                                    <td>5</td>
                                                                    <td>Seated</td>
                                                                </tr>
                                                                <tr class="danger">
                                                                    <td>1</td>
                                                                    <td>0405002255</td>
                                                                    <td>31/08/2017 - 20:30</td>
                                                                    <td>4</td>
                                                                    <td>5</td>
                                                                    <td>Finished</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>0405002255</td>
                                                                    <td>31/08/2017 - 20:30</td>
                                                                    <td>4</td>
                                                                    <td>5</td>
                                                                    <td>Canceled</td>
                                                                </tr>
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



