<?php
class Postcode{
    private $conn;
    private $table='postcodes';
    public $name;
    public $city_id;
    public $street_id;

    function __construct($db)
    {
        $this->conn=$db;
    }

    function get(){
        $query='SELECT
            postcodes.id,
            cities.name,
            streets.name,
            postcodes.number
        FROM
            postcodes,
            streets,
            cities
        WHERE
            cities.id = streets.city_id and postcodes.street_id=streets.id
        ORDER BY cities.NAME ASC';
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create(){
        $query='INSERT INTO '.$this->table.' (city_id,street_id,number) values (?,?,?)';
        $stmt=$this->conn->prepare($query);
        $this->name=trim($this->name);
        $stmt->execute([$this->city_id,$this->street_id,$this->name]);
        if($stmt)
            return true;
        return false;
    }
}
?>