<?php
class dbconnection {
        private $host="localhost";
        private $un="root";
        private $pd="";
        private $db="onlineorder";
    
    public function connection(){
       
            $con=new PDO("mysql:host=$this->host;dbname=$this->db","$this->un","$this->pd");
            return $con;
            
    }    
}

//$ob=new dbconnection();
//$con=$ob->connection();
//var_dump($con);


