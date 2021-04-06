<?php
class City{
    private $conn;
    private $table='cities';
    public $name;

    function __construct($db)
    {
        $this->conn=$db;
    }

    function get(){
        $query='SELECT * FROM '.$this->table.' order by name asc';
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create(){
        $query='INSERT INTO '.$this->table.' (name) values (?)';
        $stmt=$this->conn->prepare($query);
        $this->name=trim($this->name);
        $stmt->execute([$this->name]);
        if($stmt){
            return true;
        }
        return false;
    }
}
?>