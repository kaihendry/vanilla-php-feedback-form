<?php
switch ($_SERVER['HTTP_ORIGIN']) {
	case "http://dabase.com":
	case "http://feedback.dabase.com":
	case "http://natalian":
	case "https://natalian.org":
		header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
		break;
	default:
		die("Bad origin: " . $_SERVER['HTTP_ORIGIN']);
}


// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

	exit;
}

$subject = 'Feedback from ' . $_SERVER['REMOTE_ADDR'] . ' ' . $_SERVER['HTTP_REFERER'];
$input = json_decode(file_get_contents('php://input'), true);

if(empty($input["msg"])) { http_response_code(400); die(); }

$message = serialize($input["msg"]) . "\n\n--\n" . print_r($_SERVER, true);

if(empty($input["from"]) || !filter_var($input["from"], FILTER_VALIDATE_EMAIL)) {
	mail('hendry+feedback@iki.fi', $subject, $message);
} else {
	$headers = 'From: ' . $input["from"];
	mail('hendry+feedback@iki.fi', $subject, $message, $headers);
}
?>
