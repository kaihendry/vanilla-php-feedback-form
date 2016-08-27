<?php

require "sesmail.php";

function failzone($msg) {
		http_response_code(400);
		die($msg);
}

switch ($_SERVER['HTTP_ORIGIN']) {
	case "http://0.0.0.0:2015":
	case "http://dabase.com":
	case "https://feedback.dabase.com":
	case "https://up.dabase.com":
	case "https://natalian.org":
		header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
		break;
	default:
		failzone("Bad origin: " . $_SERVER['HTTP_ORIGIN']);
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

	exit;
}

$subject = 'Feedback from ' . $_SERVER['REMOTE_ADDR'] . ' ' . $_SERVER['HTTP_REFERER'];

if(empty($_POST["msg"])) { failzone("No message"); }

$message = $_POST["msg"] . "\n\n--\n" . json_encode($_POST, JSON_PRETTY_PRINT) . "\n\n--\n" . json_encode($_SERVER, JSON_PRETTY_PRINT);

try {
	$messageId = sesmail($subject, $message, $_POST["from"]);
} catch (Exception $e) {
	failzone($e->getMessage()."\n");
}

?>
<!DOCTYPE html>
<html lang=en>
<head>
<meta charset="utf-8" />
<meta name=viewport content="width=device-width, initial-scale=1">
<title>Thank you</title>
</head>
<body>
<h1>👍Thank you for your feedback!</h1><p>Reference: <?=$messageId;?></p>
</body>
</html>
