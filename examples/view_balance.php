<?php

require __DIR__ . '/../vendor/autoload.php';

use Txtmsg\PhpSdk\TxtmsgClient;
use Txtmsg\PhpSdk\TxtmsgException;

$client = new TxtmsgClient('your_api_key');

try {
    $balance = $client->viewBalance();
    echo 'Account Balance:' . PHP_EOL;
    print_r($balance);

    $profile = $client->viewProfile();
    echo PHP_EOL . 'Account Profile:' . PHP_EOL;
    print_r($profile);
} catch (TxtmsgException $e) {
    echo 'Error [' . $e->getCode() . ']: ' . $e->getMessage() . PHP_EOL;
}
