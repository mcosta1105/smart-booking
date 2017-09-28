<!DOCTYPE html>
<html>
    <?php
        session_start(); //GET and POST request
        
        $pageTitle = "Restaurant";
        include("includes/head.php");
        include("autoloader.php");
        $db = new Database();
        $connection = $db->getConnection();
        
        $booking_inserted = false; // variable used to check if booking is already inserted on -> booking.php
        $booking_updated = false; // variable used to check if booking is updated on -> booking_confirmation.php
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