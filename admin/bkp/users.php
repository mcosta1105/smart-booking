<?php

    session_start();
    
    $currentpage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    $user_firstName = $_SESSION["user_firstName"];
    
    if($user_firstName != null OR $user_firstName != "")
    {
        
        if(isset($_POST['user_search']))
        {
            //SEARCH BY NAME OR PHONE
            $valueToSearch = $_POST['value_to_search'];
            $search_query = "SELECT * FROM user WHERE CONCAT(first_name, phone) LIKE '%".$valueToSearch."%'";
            $result = $connection->query($search_query);
        }
        else
        {
            //LIST ALL USERS
            $query = "SELECT * FROM user";
            $result = $connection->query($query);  
        }
        
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
                    <input id="value_to_search" type="text" name="value_to_search" class="form-control" placeholder="Search..">
                    <span class="input-group-btn">
                        <button id="search-user-btn" class="btn btn-primary" type="submit" name="user_search"><i class="fa fa-search" aria-hidden="true"></i></button>
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
                                <div id="response-search"></div>
                                <?php 
                                    $counter = 0;
                                    if(!$result == null)
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
                                    <td><a href="#" data-toggle="modal" data-target="#profileModal"</a><?php echo $row['first_name'];?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#profileModal"</a><?php echo $row['phone'];?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#profileModal"</a>
                                    <?php 
                                        if($row['user_status'] == 1)
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

<script>



/*
    function userSearch()
    {
        document.getElementById("search-user-btn").disabled = true;
        var xhttp = new XMLHttpRequest();
        
        xhttp.onreadystatechange = function()
        {
            if(this.readyState == 4 && this.status == 200)
            {
                document.getElementById("search-user-btn").disabled = false;
                
                if(this.responseText == "search-ok")
                {
                    //TODO
                    window.location.reload();
                }
                else
                {
                    document.getElementById("response-search").innerHTML = this.responseText;
                }
            }
        };
        var search = document.getElementById("value_to_search");
        xhttp.open("POST", "ajax/ajaxSearch",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("value_to_search="+search.value);
    }
    */
</script>