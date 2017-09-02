<?php
    /**
     * Class to connect on the Database
     */
    class Database
    {
        //Atributes
        private $connection;
        
        /**
         * Constructor
         */
        public function __construct()
        {
            $this->connection = mysqli_connect(getenv("dbhost"),getenv("dbuser"),getenv("dbpass"),
            getenv("dbname"));
            
            if(!$this->connection){
                //if connection fails
                echo "connection failed <br>";
            }
        }
        
        /**
        * Get Connection 
        */
        public function getConnection(){
            return $this->connection;
        }
    }
?>
