# SMS.NET.BD SMS Integration with PHP Example

This PHP example demonstrates how to send SMS messages using the SMS.NET.BD SMS API in a PHP application. The provided `SMSNETBD` class simplifies the process of interacting with the SMS.NET.BD SMS API.

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

$sms = new SMSNETBD('your_api_key_here');
$response = $sms->sendSMS($message, $recipients, $schedule, $senderId);

print_r($response);
?>
```
Replace the `$message`, `$recipients`, and `$schedule` variables with your desired values.

### 2. Checking SMS Status:

```php
<?php
$requestId = 12345; // Replace with the actual request ID
$sms = new SMSNETBD('your_api_key_here');
$statusResponse = $sms->getReport($requestId);
print_r($statusResponse);
```
Replace `$requestId` with the actual request ID for which you want to check the status.

### 3. Getting API Balance:

```php
<?php
$sms = new SMSNETBD('your_api_key_here');
$balanceResponse = $sms->getBalance();
print_r($balanceResponse);
```
> Replace `"your_api_key_here"` with your actual SMS API key, and customize the example usage according to your specific needs.

## Error Handling
Ensure proper error handling in your application to handle potential issues with API requests and responses.

## Feedback and Contributions
Feedback, bug reports, and contributions are welcome. Feel free to open issues and pull requests.

For more information about sms.net.bd and its API, refer to the [SMS API Documentation](https://sms.net.bd/api).
