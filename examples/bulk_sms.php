<?php

require __DIR__ . '/../vendor/autoload.php';

use Txtmsg\PhpSdk\TxtmsgClient;
use Txtmsg\PhpSdk\TxtmsgException;

$client = new TxtmsgClient('your_api_key');

try {
    $response = $client->sendSMS([
        'recipient' => '94771234567,94777654321',
        'sender_id' => 'TXTMSG',
        'type'      => 'plain',
        'message'   => 'Bulk SMS campaign test from TXTMSG.lk',
    ]);

    print_r($response);
} catch (TxtmsgException $e) {
    echo 'Error [' . $e->getCode() . ']: ' . $e->getMessage() . PHP_EOL;
}
