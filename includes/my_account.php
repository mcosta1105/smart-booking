<!-- Modal My Account -->
<div id="myAccountModal" class="modal fade myAccountModal" role="dialog">
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
                                <?php
                                    include("includes/my_account_profile.php");
                                ?>
                            </div>
                            <div id="bookings" class="tab-pane fade">
                                <?php
                                    include("includes/my_account_booking.php");
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
  </div>
</div>



