# 📱 Txtmsg.lk PHP SDK

Official PHP SDK for interacting with the [txtmsg.lk](https://txtmsg.lk) SMS platform API. This library provides an easy way to integrate SMS functionality, contact management, and campaign features into your PHP applications.

## 🚀 Features

- 📤 Send SMS (Single messages and campaigns)
- 👥 Contact management (Groups and individual contacts)
- 📊 Message tracking and campaign analytics
- 💰 Balance checking and profile management
- 🔒 Secure API authentication

## 📦 Installation

### Manual Installation

1. Download the `TxtmsgClient.php` file
2. Include it in your PHP project:

```php
require_once 'path/to/TxtmsgClient.php';
```

## 🔧 Usage

### Initialize the Client

```php
$client = new TxtmsgClient('your_api_key');
```

### Send an SMS

```php
try {
    $response = $client->sendSMS([
        'recipient' => '94771234567',
        'sender_id' => 'TXTMSG',
        'message'   => 'Hello from txtmsg.lk!'
    ]);
    print_r($response);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

### Manage Contact Groups

```php
// Create a contact group
$response = $client->createContactGroup([
    'name' => 'My Contact Group'
]);

// View all contact groups
$groups = $client->viewAllContactGroups();
```

### Check Balance

```php
$balance = $client->viewBalance();
print_r($balance);
```

## 📚 Available Methods

### SMS Operations
- `sendSMS(array $params)` - Send a single SMS
- `sendCampaign(array $params)` - Send bulk SMS campaign
- `viewSMS(string $uid)` - View specific SMS details
- `viewAllMessages()` - List all messages
- `viewCampaign(string $uid)` - View campaign details

### Contact Management
- `createContactGroup(array $params)` - Create a new contact group
- `viewAllContactGroups()` - List all contact groups
- `updateContactGroup(string $groupId, array $params)` - Update a group
- `deleteContactGroup(string $groupId)` - Delete a group
- `createContact(string $groupId, array $params)` - Add contact to group
- `viewContact(string $groupId, string $uid)` - View contact details

### Account Management
- `viewBalance()` - Check account balance
- `viewProfile()` - View account profile

## 📘 Documentation

- [API Documentation](https://documentation.txtmsg.lk)
- [Postman Collection](https://documenter.getpostman.com/view/21165322/2sB2qf9e5y)

## 🆘 Support

- 📧 Email: support@txtmsg.lk
- 📞 Phone: +94 773 59 304 / +94 716 170 000

## 🪪 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## ✨ Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

Made with ❤️ by [txtmsg.lk](https://txtmsg.lk)
