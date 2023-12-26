# SMS.NET.BD SMS Integration with PHP Example

This PHP example demonstrates how to send SMS messages using the sms.net.bd SMS API in a PHP application. The provided `sms_net_bd` class simplifies the process of interacting with the sms.net.bd SMS API.

## Prerequisites

Before using this example, make sure you have the following prerequisites:

- SMS API key. You can obtain this key by logging into your SMS account [portal](https://portal.sms.net.bd) and accessing the API page.

## Installation

### Step 1. Clone or download this repository to your local machine.

```bash
git clone https://github.com/smsnetbd/sms-net-bd-php
```

### Step 2. Navigate to the project directory.

```bash
cd sms-net-bd-php
```

## Usage

This example includes a basic PHP script for sending SMS messages, checking SMS status, and getting your API balance.

### 1. Sending an SMS:

```php
<?php
$message = "Hello, this is a test message.";
$recipients = "01800000000,8801700000000";
$schedule = "2023-10-20 15:30:00"; // Optional
$senderId = "YourSenderId"; // Optional

$sms = new sms_net_bd('your_api_key_here');

// Send Single SMS
$response = $sms->sendSMS(
    "Hello, this is a test SMS!",
    "01701010101"
);

// Send Multiple Recipients SMS
$response = $sms->sendSMS(
    "Hello, this is a test SMS!",
    "01701010101,+8801856666666,8801349494949,01500000000"
);

// Send SMS With Sender ID or Masking Name
$response = $sms->sendSMS(
    "Hello, this is a test SMS!",
    "01701010101",
    "sms.net.bd"
);

// Schedule SMS for future delivery
$response = $sms->sendScheduledSMS(
    "Scheduled SMS",
    "8801701010101",
    $schedule // Date format: YYYY-MM-DD HH:MM:SS
);

// Schedule SMS for future delivery with Sender ID
$response = $sms->sendScheduledSMS(
    "Scheduled SMS with date",
    "8801701010101",
    $schedule,
    "sms.net.bd"
);

print_r($response);
?>
```

Replace the `$message`, `$recipients`, and `$schedule` variables with your desired values.

### 2. Checking SMS Status:

```php
<?php

$requestId = 12345; // Replace with the actual request ID
$sms = new sms_net_bd('your_api_key_here');

$statusResponse = $sms->getReport($requestId);

print_r($statusResponse);
```

Replace `$requestId` with the actual request ID for which you want to check the status.

### 3. Getting API Balance:

```php
<?php

$sms = new sms_net_bd('your_api_key_here');

$balanceResponse = $sms->getBalance();

print_r($balanceResponse);
```

> Replace `"your_api_key_here"` with your actual SMS API key, and customize the example usage according to your specific needs.

## Error Handling

Ensure proper error handling in your application to handle potential issues with API requests and responses.

- If `error` value in response is 0, then the request was successfull
- If `error` value in response is other than 0, then the request was not successfull and the `message` value in response will contain the error message

```php
<?php
$sms = new sms_net_bd('your_api_key_here');

$response = $sms->sendSMS(
    "Hello, this is a test SMS!",
    "01701010101"
);

if ($response['error'] == 0) {
    echo "SMS Sent Successfully";
} else {
    echo "Error: " . $response['message'];
}
?>
```

## Feedback and Contributions

Feedback, bug reports, and contributions are welcome. Feel free to open issues and pull requests.

For more information about sms.net.bd and its API, refer to the [SMS API Documentation](https://sms.net.bd/api).
