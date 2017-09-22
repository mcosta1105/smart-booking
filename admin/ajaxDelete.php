<?php
    //Delete
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $user_delete_phone = $_POST["phone"];
        $delete_user_query =  "DELETE FROM user WHERE phone=?";
        
        $connection = mysqli_connect(getenv("dbhost"),getenv("dbuser"),getenv("dbpass"),
        getenv("dbname"));
          
        $delete_statement = $connection->prepare($delete_user_query);
        $delete_statement->bind_param('s', $user_delete_phone);
        $delete_statement->execute();

        if($delete_statement->affected_rows == 1)
            $message = "delete-ok";
        else
           $message = "not-delete";
        
        $delete_statement->close();

        echo $message;
        
    }
?>