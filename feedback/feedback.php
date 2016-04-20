<?php
switch ($_SERVER['HTTP_ORIGIN']) {
	case "http://dabase.com":
	case "https://feedback.dabase.com":
	case "https://natalian.org":
		header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
		break;
	default:
		http_response_code(400);
		die("Bad origin: " . $_SERVER['HTTP_ORIGIN']);
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

	exit;
}

$subject = 'Feedback from ' . $_SERVER['REMOTE_ADDR'] . ' ' . $_SERVER['HTTP_REFERER'];

if(empty($_POST["msg"])) { http_response_code(400); die(); }

$message = json_encode($_POST, JSON_PRETTY_PRINT) . "\n\n--\n" . json_encode($_SERVER, JSON_PRETTY_PRINT);

if(empty($_POST["from"]) || !filter_var($_POST["from"], FILTER_VALIDATE_EMAIL)) {
	if (!mail('hendry+feedback@iki.fi', $subject, $message)) {
		http_response_code(400);
	}
} else {
	$headers = 'From: ' . $_POST["from"];
	if (!mail('hendry+feedback@iki.fi', $subject, $message, $headers)) {
		http_response_code(400);
	}

}
?>
