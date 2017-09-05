<?php

    if(isset($_POST['search']))
    {
        $valueToSearch = $_POST['value_to_search'];
        $search_query = "SELECT * FROM user WHERE CONCAT(first_name, phone) LIKE '%".$valueToSearch."%'";
        $result = $connection->query($search_query);
    }
    else
    {
        $query = "SELECT first_name, phone, status FROM user";
        $result = $connection->query($query);  
    }
    
?>
<form action="<?php echo $currentpage; ?>" method="post">
<div class="panel panel-primary">
    <div class="panel-heading">
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="input-group">
                    <input type="text" name="value_to_search" class="form-control" placeholder="Search..">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" name="search"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
                </div><!-- /input-group -->
            </div>
            <div class="col-xs-12 col-sm-6 col-md-8">
                <h4 class="text-center">User List</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Status</th>
                            </tr>
                            <tbody>
                                <?php 
                                    $counter = 0;
                                    while($row = mysqli_fetch_array($result)):
                                ?>
                                <!-- <tr> -->
                                <?php
                                    if($counter%2 == 0)
                                    {
                                        echo "<tr class=\"info\">";
                                    }
                                    else
                                    {
                                        echo "<tr>"; 
                                    }
                                        
                                    $counter++;
                                ?>
                                    <td><?php echo $row['first_name'];?></td>
                                    <td><?php echo $row['phone'];?></td>
                                    <td>
                                    <?php 
                                        if($row['status'] == 1)
                                        {
                                            echo "Active";
                                        }
                                        else
                                        {
                                            echo "Inactive";
                                        }
                                    ;?>
                                    </td>
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