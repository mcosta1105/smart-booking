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
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
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
                                            <tr id="'.$row["id"].'">
                                                <td>'.$row["id"].'</td>
                                                <td>'.$row["first_name"].'</td>
                                                <td>'.$row["last_name"].'</td>
                                                <td>'.$row["phone"].'</td>
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
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title title-blue">User Profile</h3>
        </div>
        <div class="modal-body" id="user_detail">
            
        </div>
    </div>
  </div>
</div>

<script>
 $(document).ready(function(){  
    var table = $('#users_data').DataTable();
    $('#users_data tbody').on( 'click', 'tr', function () {
    var id = $(this).attr("id");
    console.log(id);
    $.ajax({  
                url:"includes/profile.php",  
                method:"post",  
                data:{id:id},  
                success:function(data){  
                     $('#user_detail').html(data);  
                     $('#profileModal').modal("show");  
                }  
           });  
      });
 });  
</script>