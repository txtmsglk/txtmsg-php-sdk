<?php
require '../TxtmsgClient.php';

$client = new TxtmsgClient('your_api_key');

// Example: Send SMS
try {
    $response = $client->sendSMS([
        'recipient' => '94771234567',
        'sender_id' => 'TXTMSG',
        'message'   => 'This is a test SMS from the example file.'
    ]);
    print_r($response);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}