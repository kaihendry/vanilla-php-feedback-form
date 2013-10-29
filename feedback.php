<?php
$subject = $_SERVER['REMOTE_ADDR'] . ' ' . $_SERVER['HTTP_REFERER'];
$input = json_decode(file_get_contents('php://input'), true);
$message = print_r($input["msg"], true) . "\n\n" . print_r($_SERVER, true);
$headers = 'From: Webconverger filtering service feedback <filtering+service@nl.webconverger.com>' . "\r\n" .
	'Reply-To: support@webconverger.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();

mail('root', $subject, $message, $headers);
?>
