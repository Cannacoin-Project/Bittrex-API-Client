<?php

define('API_KEY', 'YOUR_API_KEY_GOES_HERE');
define('PRIVATE_KEY', 'YOUR_PRIVATE_KEY_GOES_HERE');
define('API_URL','https://bittrex.com/api/v1.1/');

function apiQuery($path, array $req = array()) {

	$req['apikey'] = API_KEY;
	$req['nonce'] = time();
	
	$queryString = http_build_query($req, '', '&');
	$requestUrl = API_URL . $path . '?' . $queryString;	
	$sign = hash_hmac('sha512', $requestUrl, PRIVATE_KEY);
	
	static $curlHandler = null;
	
	if (is_null($curlHandler)) {
		$curlHandler = curl_init();
		curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlHandler, CURLOPT_HTTPHEADER, array('apisign:'.$sign));
		curl_setopt($curlHandler, CURLOPT_HTTPGET, true);
		curl_setopt($curlHandler, CURLOPT_URL, $requestUrl);
		curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER, TRUE);
	}
	
	// run the query
	$response = curl_exec($curlHandler);
	
	if ($response === false) {
		throw new Exception('Could not get reply: ' . curl_error($curlHandler));
	}
	
	$json = json_decode($response, true);
	if (!$json) {
		throw new Exception('Invalid data received, please make sure connection is working and requested API exists');
	}
	return $json;
}

// CLI Standard Input Streams are accepted 
// format: path param1 value1 param2 value2 param3 value3
// example: market/selllimit market CCN-BTC quanitity 250.24232211 rate 0.00100000
define('STDIN',fopen("php://stdin","r"));
while($f = fgets(STDIN)) {
	$f = rtrim($f, "\n");
	$input = explode(' ', $f);
	echo $input;
	$path = $input[0];
	$params = array();
	if(count($input) > 2) {
		$rest = array_slice($input, 2);
		$i = 0;
		$key = '';
		foreach($rest as $val) {
			$mod = ++$i % 2;
			
			if(0 === $mod) {
				$params[$key] = $val;
			} else {
				$key = $val;	
			}
	
		}
	}
	$response = apiQuery($path, $params);
	echo json_encode($response, JSON_PRETTY_PRINT) . "\n";
}
