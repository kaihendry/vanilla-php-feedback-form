<?php
// TODO return HTTP error if missing msg and it fails some sanity checks
$subject = $_SERVER['REMOTE_ADDR'] . ' ' . $_SERVER['HTTP_REFERER'];
$input = json_decode(file_get_contents('php://input'), true);
$message = print_r($input["msg"], true) . "\n\n--\n" . print_r($_SERVER, true);
mail('root', $subject, $message);
?>
