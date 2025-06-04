<?php
require '../TxtmsgClient.php';

$client = new TxtmsgClient('your_api_key');

try {
    // Check balance
    $balance = $client->viewBalance();
    echo "Account Balance:\n";
    print_r($balance);

    // View profile
    $profile = $client->viewProfile();
    echo "\nAccount Profile:\n";
    print_r($profile);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}