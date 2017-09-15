<?php

    session_start();
    
    $currentpage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    include("includes/booking_management.php");
    
    date_default_timezone_set('Australia/Sydney');
    $currentDate = date('Y-m-d');
    
    $user_firstName = $_SESSION["user_firstName"];
    
    if($user_firstName != null OR $user_firstName != "")
    {
        if(isset($_POST['date_search']))
        {
            //SEARCH BY DATE
            $dateToSerch =$_POST['date_to_search'];
             
            $query  = "SELECT * FROM booking INNER JOIN user ON booking.user_id = user.id 
                           WHERE booking.date LIKE '%".$dateToSerch."%'
                           GROUP BY user.id
                           ORDER BY booking.date";
        
            $result = $connection->query($query);
        }
        else if(isset($_POST['search']))
        {
            //SEARCH BY NAME, PHONE OR DATE
            $bookingToSearch = $_POST['booking_to_search'];
           
            $query  = "SELECT * FROM booking INNER JOIN user ON booking.user_id = user.id 
                       WHERE user.first_name LIKE '%".$bookingToSearch."%'
                       OR user.phone LIKE '%".$bookingToSearch."%'
                       OR booking.date LIKE '%".$bookingToSearch."%'
                       GROUP BY user.id
                       ORDER BY booking.date";
    
            $result = $connection->query($query);
        }
        else
        {
            //SEARCH WITH CURRENT DATE
            $query = "SELECT * FROM booking 
            INNER JOIN user ON booking.user_id = user.id 
            WHERE booking.date LIKE '%".$currentDate."%'
            GROUP BY user.id ORDER BY booking.date";
            
            $result = $connection->query($query);
        }
    }
    else{
        $result = array("0" =>"Not Logged In!");
    }
    
    
?>
<form action = "<?php echo $currentpage; ?>" method="post">
    <div class="panel panel-primary">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <h4 class="text-center">Search by Date</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar fa-lg" aria-hidden="true"></i></span>
                        <input type="date" name="date_to_search" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" name="date_search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </span>
                    </div>
                    <br>
                    <h4 class="text-center">Or Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control" name="booking_to_search" placeholder="Search..">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" name="search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </span>
                    </div><!-- /input-group -->
                </div>
                <div class="col-xs-12 col-sm-6 col-md-8">
                    <h4 class="text-center">Bookings List</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Table</th>
                                    <th>People</th>
                                    <th>Status</th>
                                    <th>Title</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Special Request</th>
                                </tr>
                                <tbody>
                                    <?php 
                                        $counter = 0;
                                        while($row = mysqli_fetch_array($result)):
                                    ?>
                                    <?php
                                            if($counter%2 == 0)
                                            {
                                                echo "<tr class=\"info\">";
                                            }
                                            else{
                                                echo "<tr>";
                                            }
                                            
                                            $counter++;
                                    ?>
                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a><?php echo $row['date'];?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a><?php echo $row['time'];?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a><?php echo $row['table_id'];?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a><?php echo $row['no_people'];?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a>
                                    <?php 
                                    
                                        //Not Seated = 1
                                        //Seated = 2
                                        //Finished = 3
                                        //Canceled = 4
                                    
                                        if($row['status'] == 1)
                                        {
                                            echo "Not Seated";
                                        }
                                        else if($row['status'] == 2)
                                        {
                                            echo "Seated";
                                        }
                                        else if($row['status'] == 3)
                                        {
                                            echo "Finished";
                                        }
                                        else if($row['status'] == 4)
                                        {
                                            echo "Canceled";
                                        }
                                    ?>
                                    </td>
                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a><?php echo $row['title'];?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a><?php echo $row['first_name'];?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a><?php echo $row['phone'];?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#bookingManagementModal"</a><?php echo $row['special_request'];?></td>
                                    </tr>
                                    <?php endwhile;?>
                                </tbody>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
