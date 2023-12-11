# SMS.NET.BD SMS Integration with PHP Example

This PHP example demonstrates how to send SMS messages using the Alpha SMS API in a PHP application. The provided `AlphaSMS` class simplifies the process of interacting with the Alpha SMS API.

## Prerequisites

Before using this example, make sure you have the following prerequisites:

- An Alpha SMS API key. You can obtain this key by logging into your Alpha SMS account and accessing the API page.

## Installation

1. Clone or download this repository to your local machine.

```bash
git clone https://github.com/alphanetbd/alpha-sms-php
```
2. Navigate to the project directory.

```bash
cd alpha-sms-php
```
3. Open the `AlphaSMS.class.php` file and replace 'your_api_key_here' with your Alpha SMS API key.

## Usage

This example includes a basic PHP script for sending SMS messages, checking SMS status, and getting your API balance.

1. Sending an SMS:

Replace the $message, $recipients, and $schedule variables with your desired values.

```php
<?php
$message = "Hello, this is a test message.";
$recipients = "01800000000,8801700000000";
$schedule = "2023-10-20 15:30:00"; // Optional
$senderId = "YourSenderId"; // Optional

$alphaSMS = new AlphaSMS('your_api_key_here');
$response = $alphaSMS->sendSMS($message, $recipients, $schedule, $senderId);

print_r($response);
?>
```

2. Checking SMS Status:

Replace $requestId with the actual request ID for which you want to check the status.

```php
<?php
$requestId = 12345; // Replace with the actual request ID
$alphaSMS = new AlphaSMS('your_api_key_here');
$statusResponse = $alphaSMS->getReport($requestId);
print_r($statusResponse);
```

3. Getting API Balance:

```php
<?php
$alphaSMS = new AlphaSMS('your_api_key_here');
$balanceResponse = $alphaSMS->getBalance();
print_r($balanceResponse);
```

## Error Handling
Ensure proper error handling in your application to handle potential issues with API requests and responses.

## Feedback and Contributions
Feedback, bug reports, and contributions are welcome. Feel free to open issues and pull requests.

For more information about Alpha SMS and its API, refer to the [Alpha SMS API Documentation](https://alpha.net.bd/SMS/API/).


Replace `"your_api_key_here"` with your actual Alpha SMS API key, and customize the example usage according to your specific needs.
