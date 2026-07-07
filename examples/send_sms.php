<?php

require __DIR__ . '/../vendor/autoload.php';

use Txtmsg\PhpSdk\TxtmsgClient;
use Txtmsg\PhpSdk\TxtmsgException;

$client = new TxtmsgClient('your_api_key');

try {
    $response = $client->sendSMS([
        'recipient' => '94771234567',
        'sender_id' => 'TXTMSG',
        'message'   => 'This is a test SMS from the TXTMSG.lk PHP SDK.',
    ]);

    print_r($response);
} catch (TxtmsgException $e) {
    echo 'Error [' . $e->getCode() . ']: ' . $e->getMessage() . PHP_EOL;
}
