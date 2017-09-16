<?php

    session_start();
    
    $currentpage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    $user_firstName = $_SESSION["user_firstName"];
    
    if($user_firstName != null OR $user_firstName != "")
    {
        $search_query = "SELECT * FROM user ORDER BY first_name";
        $result = $connection->query($search_query);
    }
?>
<form action="<?php echo $currentpage; ?>" method="post">
<div class="panel panel-primary">
    <div class="panel-heading">
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h4 class="text-center">User List</h4>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered" id="users_data">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                            <tbody>
                                <?php 
                                    $counter = 0;
                                    if(!$result == null)
                                    {
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            if($row['user_status'] == 1)
                                            {
                                                $status = "Active";
                                            }
                                            else
                                            {
                                                $status = "Inactive";
                                            }
                                        
                                            echo '
                                            <tr>
                                                <td><a href="#" data-toggle="modal" data-target="#profileModal"</a>'.$row["first_name"].'</td>
                                                <td><a href="#" data-toggle="modal" data-target="#profileModal"</a>'.$row["last_name"].'</td>
                                                <td><a href="#" data-toggle="modal" data-target="#profileModal"</a>'.$row["phone"].'</td>
                                                <td><a href="#" data-toggle="modal" data-target="#profileModal"</a>'.$row["email"].'</td>
                                                <td><a href="#" data-toggle="modal" data-target="#profileModal"</a>'.$status.'</td>
                                            </tr>
                                            ';
                                        }
                                    }
                                ?>
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<script>
 $(document).ready(function(){  
      $('#users_data').DataTable();  
 });  
</script>