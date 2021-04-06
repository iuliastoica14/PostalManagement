<?php
    header('Content-Type: application/json');

    include_once('../../classes/connection.php');
    include_once('../../classes/city.php');

    $conn=new Connection();
    $db=$conn->connect();

    $city=new City($db);
    
    $data=$_POST;
    
    if(preg_match("/(^[A-Za-z\s-]+$)/",$data['name'])){
        $city->name=$data['name'];

        if($city->create()){
            echo json_encode(array('message'=> 'Adaugat','status'=>true));
        } else{
            echo json_encode(array('message'=> 'Nu a putut fi adaugat','status'=>false));
        }
    }
    else{
        echo json_encode(array('message'=> 'Format incorect','status'=>false));
    }


?>