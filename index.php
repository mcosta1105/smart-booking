<!DOCTYPE html>
<html>
    <?php
        session_start(); //GET and POST request
        
        $pageTitle = "Restaurant";
        include("includes/head.php");
        include("autoloader.php");
        $db = new Database();
        $connection = $db->getConnection();
    ?>
    <body>
        <span id="index"></span>
        <?php
        include("includes/navigation.php");
        
        include("includes/feature.php");
        
        include("includes/about.php");
        
        include("includes/menu.php");
        
        include("includes/location.php");
        
        include("includes/footer.php");
        ?>
    </body> 
</html>