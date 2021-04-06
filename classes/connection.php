<?php

class Connection{
    private $conn;

    function connect()
    {
        $this->conn=null;
        try{
        $this->conn=new PDO('mysql:host=localhost;dbname=postcodes_management','root','');
        }catch (PDOException $e){
            echo $e->getMessage();
        }

        return $this->conn;
    }
}
?>