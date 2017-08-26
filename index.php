<!DOCTYPE html>
<html>
    <?php
        $pageTitle = "Restaurant";
        include("includes/head.php");
        include("includes/database.php");
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