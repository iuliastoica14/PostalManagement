<?php
class Street{
    private $conn;
    private $table='streets';
    public $name;
    public $city_id;

    function __construct($db)
    {
        $this->conn=$db;
    }

    function get(){
        $query='SELECT
            streets.id,
            cities.name,
            streets.name
        FROM
            streets,
            cities
        WHERE
            cities.id = streets.city_id  
        ORDER BY cities.name ASC';
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function getByCity(){
        $query='SELECT
            streets.id,
            cities.name,
            streets.name
        FROM
            streets,
            cities
        WHERE
            cities.id = streets.city_id and cities.id=? 
        ORDER BY streets.name ASC';
        $stmt=$this->conn->prepare($query);
        $stmt->execute([$this->city_id]);
        return $stmt;
    }

    public function getStreetsByCity() {
		// create query
		$query = 'SELECT * FROM ' . $this->table . ' WHERE city_id= ' . $this->city_id . ' ORDER BY name ASC';
		
		// prepare statement
		$stmt = $this->conn->prepare($query);
		
		// execute query
		$stmt->execute();

		return $stmt;
	}

    function create(){
        $query='insert into '.$this->table.' (city_id,name) values (?,?)';
        $stmt=$this->conn->prepare($query);
        $this->name=trim($this->name);
        $stmt->execute([$this->city_id,$this->name]);
        if($stmt)
            return true;
        return false;
    }
}
?>