<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
	// TODO: compare $_SERVER['HTTP_ORIGIN'] to the list of domains you'd like to allow
	header("Access-Control-Allow-Origin: http://dabase.com");
	// header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

	exit(0);
}

$subject = $_SERVER['REMOTE_ADDR'] . ' ' . $_SERVER['HTTP_REFERER'];
$input = json_decode(file_get_contents('php://input'), true);
if(empty($input["msg"])) { http_response_code(400); die(); }
$message = $input["msg"] . "\n\n--\n" . print_r($_SERVER, true);
if(empty($input["from"])) {
	mail('root', $subject, $message);
} else {
	$headers = 'From: ' . $input["from"];
	mail('root', $subject, $message, $headers);
}
?>
