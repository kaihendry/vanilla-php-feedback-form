<?php

// if(empty($_POST["from"]) || !filter_var($_POST["from"], FILTER_VALIDATE_EMAIL)) {
require '../vendor/autoload.php';
use Aws\Ses\SesClient;

function sesMail($subject, $message, $replyto) {

$fromAdr = getenv("FROM");

$SesClient = new Aws\Ses\SesClient([
	'version'   =>  'latest',
	'region'    =>  getenv("REGION")
]);

$result = $SesClient->sendEmail([
	'Destination' => [
		'ToAddresses' => [
			getenv("TO")
		],
	],
	'Message' => [
		'Body' => [
			'Text' => [
				'Charset' => 'UTF-8',
				'Data' => $message,
			],
		],
		'Subject' => [
			'Charset' => 'UTF-8',
			'Data' => $subject,
		],
	],
	'ReplyToAddresses' => [$replyto],
	'ReturnPath' => $fromAdr,
	'Source' => $fromAdr,
]);

return $result['MessageId'];

}

?>
