<?php
    header('Content-Type: application/json');

    include_once('../../classes/connection.php');
    include_once('../../classes/street.php');

    $conn=new Connection();
    $db=$conn->connect();

    $street=new Street($db);

    $data=$_POST;

    if(preg_match("/(^[A-Za-z\s\d-]+$)/",$data['name'])){
        $street->name=$data['name'];
        $street->city_id=$data['street_city'];
        
        if($street->create()){
            echo json_encode(
                array('message' => 'Adaugat', 'status' => true)
            );
        }
        else {
            echo json_encode(
                array('message' => 'Nu s-a putut adauga', 'status' => false)
            );
        }
    }else{
        echo json_encode(array('message'=> 'Format incorect','status'=>false));
    }
?>