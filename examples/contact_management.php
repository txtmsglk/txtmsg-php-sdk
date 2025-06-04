<?php
require '../TxtmsgClient.php';

$client = new TxtmsgClient('your_api_key');

try {
    // Create a contact group
    $group = $client->createContactGroup([
        'name' => 'Test Group'
    ]);
    echo "Created Group:\n";
    print_r($group);

    // Add contacts to group
    $contact = $client->createContact($group['id'], [
        'name' => 'John Doe',
        'mobile' => '94771234567',
        'email' => 'john@example.com'
    ]);
    echo "\nAdded Contact:\n";
    print_r($contact);

    // View all groups
    $groups = $client->viewAllContactGroups();
    echo "\nAll Groups:\n";
    print_r($groups);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}