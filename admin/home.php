<!DOCTYPE html>
<html>
    <?php
    
        session_start();
        
        $pageTitle = "Admin/Home";
        
        include("../admin/includes/head.php");
        include("autoloader.php");
        
        $db = new Database();
        $connection = $db->getConnection();
        
        $user_firstName = $_SESSION["user_firstName"];
        
    ?>
    <body>
        <?php
            include("../admin/includes/navigation.php");
        ?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs nav-justified" id="adminTab">
                            <li role="presentation" class="active"><a data-toggle="tab" href="#bookings">Bookings</a></li>
                            <li role="presentation">
                            <a data-toggle="tab" href="#users">Users</a></li>
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
<script>
    //Get current tab when reload the page
    $('#adminTab a').click(function(e) 
    {
      e.preventDefault();
      $(this).tab('show');
    });
    
    //Store the currently selected tab in the hash value
    $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) 
    {
      var id = $(e.target).attr("href").substr(1);
      window.location.hash = id;
    });
    
    //On load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    $('#adminTab a[href="' + hash + '"]').tab('show');
</script>