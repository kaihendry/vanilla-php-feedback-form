<?php
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
