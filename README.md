# TXTMSG.lk PHP SDK — PHP SMS Gateway Integration for Sri Lanka

Official PHP SDK for [TXTMSG.lk](https://txtmsg.lk) — [Sri Lanka's SMS gateway](https://txtmsg.lk) API v3. Send [bulk SMS](https://txtmsg.lk/pricing), transactional SMS, campaigns, and manage contacts from any PHP 8.1+ application. Get started with [free trial credits](https://txtmsg.lk/register).

## Features

- **Send SMS** — Deliver single or bulk messages to any country via REST API
- **Campaign Management** — Send SMS campaigns using contact lists
- **Contact Groups** — Create, update, and manage contact groups
- **Contacts** — Import and manage individual contacts within groups
- **Schedule Messages** — Set future delivery times for your SMS
- **Balance & Profile** — Check remaining SMS units and account details
- **DLT Support** — Send DLT-compliant messages with template IDs
- **Guzzle HTTP Client** — Built on Guzzle 7 with PSR-18 support

## Requirements

- PHP 8.1+
- `guzzlehttp/guzzle` ^7.0 (installed automatically)

## Installation

Install via Composer:

```bash
composer require txtmsg/php-sdk
```

## Quick Start

### Initialize the Client

```php
use Txtmsg\PhpSdk\TxtmsgClient;

$client = new TxtmsgClient('your_api_key');
```

[Get your API key →](https://txtmsg.lk/register)

### Send an SMS

```php
use Txtmsg\PhpSdk\TxtmsgClient;
use Txtmsg\PhpSdk\TxtmsgException;

$client = new TxtmsgClient('your_api_key');

try {
    $response = $client->sendSMS([
        'recipient' => '94771234567',
        'sender_id' => 'TXTMSG',
        'type'      => 'plain',
        'message'   => 'Hello from TXTMSG.lk!',
    ]);

    print_r($response);
} catch (TxtmsgException $e) {
    echo 'Error: ' . $e->getMessage();
}
```

### Check Balance

```php
$balance = $client->viewBalance();
print_r($balance);
```

### Send a Campaign to Contact Lists

```php
$client->sendCampaign([
    'contact_list_id' => '6415907d0d37a',
    'sender_id'       => 'TXTMSG',
    'type'            => 'plain',
    'message'         => 'Campaign message',
    'schedule_time'   => '2025-12-20 07:00',
]);
```

## API Reference

All methods return an array with the API response.

### SMS Operations

| Method | Description |
|--------|-------------|
| `sendSMS(array $params)` | Send SMS via POST (single & bulk) |
| `sendSMSViaGet(array $params)` | Send SMS via GET (simpler alternative) |
| `sendCampaign(array $params)` | Send campaign to contact list(s) |
| `viewSMS(string $uid)` | View details of a sent SMS |
| `viewAllMessages()` | List all sent messages with pagination |
| `viewCampaign(string $uid)` | View campaign details |

### Contact Groups

| Method | Description |
|--------|-------------|
| `viewAllContactGroups()` | Retrieve all contact groups |
| `createContactGroup(array $params)` | Create a new contact group |
| `viewContactGroup(string $groupId)` | Get group details |
| `updateContactGroup(string $groupId, array $params)` | Update a group |
| `deleteContactGroup(string $groupId)` | Delete a group |

### Contacts

| Method | Description |
|--------|-------------|
| `createContact(string $groupId, array $params)` | Add a contact to a group |
| `viewContact(string $groupId, string $uid)` | View contact details |
| `updateContact(string $groupId, string $uid, array $params)` | Update a contact |
| `deleteContact(string $groupId, string $uid)` | Delete a contact |
| `viewAllContactsInGroup(string $groupId)` | List contacts in a group |

### Account

| Method | Description |
|--------|-------------|
| `viewBalance()` | Check remaining SMS units |
| `viewProfile()` | View account profile |

## SMS Parameters

| Parameter | Required | Description |
|-----------|----------|-------------|
| `recipient` | Yes | Phone number(s). Use comma for multiple |
| `sender_id` | Yes | Sender ID (max 11 characters) |
| `type` | Yes | Message type (`plain`) |
| `message` | Yes | SMS message body |
| `schedule_time` | No | Schedule delivery (Y-m-d H:i) |
| `dlt_template_id` | No | DLT template ID |

## About TXTMSG.lk

[TXTMSG.lk](https://txtmsg.lk) is a [Sri Lankan SMS gateway](https://txtmsg.lk) provider offering reliable [bulk SMS services](https://txtmsg.lk/pricing), [transactional SMS APIs](https://txtmsg.lk/developers), and [messaging solutions](https://txtmsg.lk/solutions) for businesses. The API v3 provides RESTful endpoints for SMS delivery, contact management, and campaign automation with worldwide coverage.

## Links

- 🌐 [Website](https://txtmsg.lk)
- 💰 [Pricing](https://txtmsg.lk/pricing)
- 📖 [API Documentation](https://documentation.txtmsg.lk)
- 🧪 [Postman Collection](https://documenter.getpostman.com/view/21165322/2sB2qf9e5y)
- 🚀 [Create Free Account](https://txtmsg.lk/register)

## Support

- Email: support@txtmsg.lk
- Phone: +94 773 59 304 / +94 716 170 000

## License

MIT — see the [LICENSE](LICENSE) file.

## Changelog

### v2.0.0
- Added namespace (`Txtmsg\PhpSdk`) and PSR-4 autoloading
- Replaced cURL with Guzzle HTTP client
- PHP 8.1+ with typed properties and return types
- Added `TxtmsgException` for typed error handling
- Customizable Guzzle client via constructor injection
