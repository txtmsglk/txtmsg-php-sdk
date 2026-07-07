<?php

require __DIR__ . '/../vendor/autoload.php';

use Txtmsg\PhpSdk\TxtmsgClient;
use Txtmsg\PhpSdk\TxtmsgException;

$client = new TxtmsgClient('your_api_key');

try {
    $group = $client->createContactGroup([
        'name' => 'Test Group',
    ]);

    echo 'Created Group:' . PHP_EOL;
    print_r($group);

    if (isset($group['data']['uid'])) {
        $contact = $client->createContact($group['data']['uid'], [
            'PHONE'     => '94771234567',
            'FIRST_NAME' => 'John',
            'LAST_NAME'  => 'Doe',
        ]);

        echo PHP_EOL . 'Added Contact:' . PHP_EOL;
        print_r($contact);
    }

    $groups = $client->viewAllContactGroups();
    echo PHP_EOL . 'All Groups:' . PHP_EOL;
    print_r($groups);
} catch (TxtmsgException $e) {
    echo 'Error [' . $e->getCode() . ']: ' . $e->getMessage() . PHP_EOL;
}
