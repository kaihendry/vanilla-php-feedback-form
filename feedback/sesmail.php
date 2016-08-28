<?php

require '../vendor/autoload.php';
use Aws\Ses\SesClient;

function sesMail($subject, $message, $replyto) {

$SesClient = new Aws\Ses\SesClient([
	'version'   =>  'latest',
	'region'    =>  getenv("REGION")
]);

$msg = array();
$msg['Source'] = getenv("FROM");
$msg['Destination']['ToAddresses'][] = getenv("TO");
$msg['Message']['Subject']['Data'] = $subject;
$msg['Message']['Subject']['Charset'] = "UTF-8";
$msg['Message']['Body']['Text']['Data'] = $message;
$msg['Message']['Body']['Text']['Charset'] = "UTF-8";

if(!empty($replyto) && filter_var($replyto, FILTER_VALIDATE_EMAIL)) {
	$msg['ReplyToAddresses'][] = $replyto;
}

$result = $SesClient->sendEmail($msg);
return $result['MessageId'];

}

?>
