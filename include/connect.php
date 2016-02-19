<?php
    class connect{
        private $conn;

        //Connect to the database
        public function db_connect(){
            
            require_once "include/config.php"; //includes the file just once 
            $this->conn= new mysqli(host,username,password,database); 

            return $this->conn;
        }
    }
?>