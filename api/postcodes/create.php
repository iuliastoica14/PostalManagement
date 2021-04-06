<?php
    header('Content-Type: application/json');

    include_once('../../classes/connection.php');
    include_once('../../classes/postcode.php');

    $conn=new Connection();
    $db=$conn->connect();

    $postcode=new Postcode($db);

    $data=$_POST;
    if(preg_match("/(^[\d-]+$)/",$data['name'])){
        $postcode->name=$data['name'];
        $postcode->city_id=$data['city_postcode'];
        $postcode->street_id=$data['street_postcode'];

        if($postcode->create()){
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