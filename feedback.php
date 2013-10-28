<?php
$to      = 'root';
$subject = $_SERVER['REMOTE_ADDR'];
$input = json_decode(file_get_contents('php://input'), true);
$message = print_r($input["msg"], true) . print_r($_SERVER, true);
$headers = 'From: Webconverger filtering service feedback <filtering+service@nl.webconverger.com>' . "\r\n" .
	'Reply-To: support@webconverger.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>
