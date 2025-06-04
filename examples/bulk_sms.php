<?php
require '../TxtmsgClient.php';

$client = new TxtmsgClient('your_api_key');

// Example: Send bulk SMS campaign
try {
    $response = $client->sendCampaign([
        'recipients' => ['94771234567', '94777654321'],
        'sender_id' => 'TXTMSG',
        'message' => 'Bulk SMS campaign test'
    ]);
    echo "Campaign Response:\n";
    print_r($response);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}