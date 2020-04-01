<?php

header("Access-Control-Allow-Origin: *");
require __DIR__ . '/vendor/autoload.php';


$account_sid = '2dc079aa';
$auth_token = 'gWq3A81WmFc8xxV5';

$basic  = new \Nexmo\Client\Credentials\Basic($account_sid, $auth_token);
$client = new \Nexmo\Client($basic);
try {
    $message = $client->message()->send([
        'to' => '40766546354',
        'from' => 'Acme Inc',
        'text' => 'Salu Ghita'
    ]);
    $response = $message->getResponseData();
    if($response['messages'][0]['status'] == 0) {
        echo "The message was sent successfully\n";
    } else {
        echo "The message failed with status: " . $response['messages'][0]['status'] . "\n";
    }
} catch (Exception $e) {
    echo "The message was not sent. Error: " . $e->getMessage() . "\n";
}