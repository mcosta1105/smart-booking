<?php

    session_start();
    
    $currentpage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    $user_firstName = $_SESSION["user_firstName"];
    
    //Delete
    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] == "delete")
    {
        $user_delete_phone = $_POST["phone"];
        $delete_user_query =  "DELETE FROM user WHERE phone=?";
        
        $connection = mysqli_connect(getenv("dbhost"),getenv("dbuser"),getenv("dbpass"),
        getenv("dbname"));
          
        $delete_statement = $connection->prepare($delete_user_query);
        $delete_statement->bind_param('s', $user_delete_phone);
        $delete_statement->execute();

        if($delete_statement->affected_rows == 1)
            $message = 'User deleted';
        else
           $message = 'User not deleted';
        
        $delete_statement->close();

        echo "<script type='text/javascript'>alert('$message');</script>";
        
    }
    
    //Update
    /*if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] == "update")
    {
        //TODO
        
        $user_update_phone = $_POST["phone"];
        $update_user_query =  "DELETE FROM user WHERE phone=?";
        
        $connection = mysqli_connect(getenv("dbhost"),getenv("dbuser"),getenv("dbpass"),
        getenv("dbname"));
          
        $update_statement = $connection->prepare($update_user_query);
        $update_statement->bind_param('s', $user_delete_phone);
        $update_statement->execute();

        if($update_statement->affected_rows == 1)
            $message = 'User deleted';
        else
           $message = 'User not deleted';
        
        $update_statement->close();

        echo "<script type='text/javascript'>alert('$message');</script>";
        
    }*/
    
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
                                <th>Phone</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Level</th>
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
                                        
                                            if($row['level'] == 1)
                                            {
                                                $level = "User";
                                            }
                                            else
                                            {
                                                $level = "Admin";
                                            }
                                        
                                            echo '
                                            <tr id="'.$row["phone"].'">
                                                <td>'.$row["phone"].'</td>
                                                <td>'.$row["first_name"].'</td>
                                                <td>'.$row["last_name"].'</td>
                                                <td>'.$row["email"].'</td>
                                                <td>'.$level.'</td>
                                                <td>'.$status.'</td>
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

<!-- Modal -->
<div id="profileModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <form id="profile-form" action="<?php echo $currentpage;?>" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title title-blue">User Profile</h3>
            </div>
            <div class="modal-body" id="user_detail">
                
            </div>
            <div class="modal-footer">
                <div class="text-center"> 
                    <button type="submit" name="submit" value="update" class="btn btn-primary">Update</button>
                    <button type="submit" name="submit" value="delete" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>

<script>
 $(document).ready(function(){  
    var table = $('#users_data').DataTable();
    $('#users_data tbody').on( 'click', 'tr', function () {
    var phone = $(this).attr("id");
    console.log(phone);
    $.ajax({  
                url:"includes/profile.php",  
                method:"post",  
                data:{phone:phone},  
                success:function(data){  
                     $('#user_detail').html(data);  
                     $('#profileModal').modal("show");  
                }  
           });  
      });
 });  
</script>