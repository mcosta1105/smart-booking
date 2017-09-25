<?php

    session_start();
    
    $currentpage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    $user_firstName = $_SESSION["user_firstName"];
    
    //Populate Table with all users
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
                <div class="text-center" id="success-update">
                    
                </div>
                <div class="text-center" id="success-delete">
                    
                </div>
                <div class="text-center"> 
                    <button id="delete-btn" onClick="processDelete()" type="submit" name="submit" value="delete" class="btn btn-danger">Delete</button>
                    <button id="update-btn" onClick="checkUpdate()" type="submit" name="submit" value="update" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>

<script>
 $(document).ready(function(){  
    table = $('#users_data').DataTable();
    $('#users_data tbody').on( 'click', 'tr', function () {
    var phone = $(this).attr("id");
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

    //AJAX update
    function checkUpdate(){
     document.getElementById("update-btn").disabled = true;
     var updatexhttp = new XMLHttpRequest();
     updatexhttp.onreadystatechange = function()
     {
         
         if(this.readyState == 4 && this.status == 200)
         {
             document.getElementById("update-btn").disabled = false;
             if(this.responseText == "update-ok")
             { 
                 document.getElementById("success-update").innerHTML = "<div class=\"alert alert-success fade in alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong>Successfully Updated!</strong></div>";
                 //reload screen when close modal
                 $('#profileModal').on('hidden.bs.modal', function () {
                    location.reload();
                 });
             }
             else
             {
                 var myUpdateObj = JSON.parse(this.responseText);
                 if(myUpdateObj.firstName != null)
                 {
                     document.getElementById("error-update-firstName").innerHTML = myUpdateObj.firstName;
                 }
                 if(myUpdateObj.lastName != null)
                 {
                     document.getElementById("error-update-lastName").innerHTML = myUpdateObj.lastName;
                 }
                 
             }
         }
     };
     var title = document.getElementById("title"),
      firstName = document.getElementById("firstName"),
      lastName = document.getElementById("lastName"),
      email = document.getElementById("email"),
      phone = document.getElementById("phone"),
      user_request = document.getElementById("user_request"),
      level = document.getElementById("level"),
      status = document.getElementById("status");
      updatexhttp.open("POST","ajaxUpdate.php",true);
      updatexhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      updatexhttp.send("title="+title.value+"&firstName="+firstName.value+"&lastName="+lastName.value+"&phone="+phone.value+"&user_request="+user_request.value+"&level="+level.value+"&status="+status.value);
 }
 
 //Delete function
 function processDelete()
 {
    document.getElementById("delete-btn").disabled = true;
    var deletexhttp = new XMLHttpRequest();
    deletexhttp.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
             if(this.responseText == "delete-ok")
             {
                document.getElementById("update-btn").disabled = true; 
                document.getElementById("success-delete").innerHTML = "<div class=\"alert alert-success fade in alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong>Successfully Deleted!</strong></div>";
                //reload screen when close modal
                 $('#profileModal').on('hidden.bs.modal', function () {
                    location.reload();
                 });
            }
            else
            {
                document.getElementById("delete-btn").disabled = false;
                document.getElementById("success-delete").innerHTML = "<div class=\"alert alert-warning fade in alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong>Not Deleted, Error!</strong></div>";    
            }
        }
    };
    var phone = document.getElementById("phone");
    deletexhttp.open("POST", "ajaxDelete.php", true);
    deletexhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    deletexhttp.send("phone="+phone.value);
 }
 

</script>