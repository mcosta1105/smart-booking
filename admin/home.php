<!DOCTYPE html>
<html>
    <?php
        $pageTitle = "Admin/Home";
        include("../admin/includes/head.php");
        
    ?>
    <body>
        <?php
            include("../admin/includes/navigation.php");
        ?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs nav-justified">
                            <li role="presentation" class="active"><a data-toggle="tab" href="#bookings">Bookings</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#users">Users</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content">
                            <div id="bookings" class="tab-pane fade in active">
                                <?php include("includes/bookings.php"); ?>
                            </div>
                            <div id="users" class="tab-pane fade">
                                <?php include("includes/users.php"); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>