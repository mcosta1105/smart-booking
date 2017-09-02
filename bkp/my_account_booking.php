<?php
    include("includes/my_account_booking_management.php");
?>
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