<?php

    session_start();
    //include("autoloader.php");
    
    //$db = new Database();
    //$connection = $db->getConnection();
    
     if($_POST['value_to_search'])
     {
        if(isset($_POST['user_search']))
        {
            //SEARCH BY NAME OR PHONE
            $valueToSearch = $_POST['value_to_search'];
            $search_query = "SELECT * FROM user WHERE CONCAT(first_name, phone) LIKE '%".$valueToSearch."%'";
            $result = $connection->query($search_query);
            echo "search-ok";
            return $result;
            
        }
        else
        {
            //LIST ALL USERS
            $query = "SELECT * FROM user";
            $result = $connection->query($query);  
            echo "search-ok";
            return $result;
            
        }
     }
     else
     {
         echo "search-error";
     }
    
?>