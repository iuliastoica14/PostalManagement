<?php
header('Content-Type: application/json');

include_once('../../classes/connection.php');
include_once('../../classes/street.php');

$connection = new Connection();
$db = $connection->connect();

$street = new Street($db);

// get posted data
$data = $_POST;
$street->city_id = $data['city_id'];

$result = $street->getStreetsByCity();
$street_num = $result->rowCount();

if($street_num > 0) {
	$response = $result->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($response);
}
else {
	echo json_encode(
		array('error' => 'No results')
	);
}