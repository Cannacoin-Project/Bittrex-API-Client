<?php 
require_once('client.php');

$path = 'account/getbalance';
$params = [
	"currency" => "BTC",
];
	
$response = apiQuery($path, $params);
echo json_encode($response);

?>