<?php

class sms_net_bd
{
    private $apiUrl = 'https://api.sms.net.bd';
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function sendSMS($message, $recipients, $senderId = null)
    {

        if (empty($this->apiKey)) {
            throw new \Exception('API key is required');
        }

        $url = "{$this->apiUrl}/sendsms";

        $params = [
            'api_key' => $this->apiKey,
            'msg' => $message,
            'to' => $recipients,
            'sender_id' => $senderId,
        ];

        return $this->makeRequest('POST', $url, $params);
    }

    public function sendScheduledSMS($message, $recipients, $schedule, $senderId = null)
    {

        if (empty($this->apiKey)) {
            throw new \Exception('API key is required');
        }

        $url = "{$this->apiUrl}/sendsms";

        $params = [
            'api_key' => $this->apiKey,
            'msg' => $message,
            'to' => $recipients,
            'sender_id' => $senderId,
        ];

        $currentDate = new \DateTime('now', new \DateTimeZone('Asia/Dhaka'));

        $scheduleTime = strtotime(
            $schedule,
            $currentDate->getTimestamp()
        );

        // check the timestamp is before the current time
        if ($scheduleTime < time()) {
            throw new \Exception('Schedule time must be in the future');
        }

        $params['schedule'] = date('Y-m-d H:i:s', $scheduleTime); // in YYYY-MM-DD HH:MM:SS format

        return $this->makeRequest('POST', $url, $params);
    }

    public function getReport($requestId)
    {

        if (empty($this->apiKey)) {
            throw new \Exception('API key is required');
        }

        $url = "{$this->apiUrl}/report/request/{$requestId}";

        $params = ['api_key' => $this->apiKey];

        return $this->makeRequest('GET', $url, $params);
    }

    public function getBalance()
    {

        if (empty($this->apiKey)) {
            throw new \Exception('API key is required');
        }

        $url = "{$this->apiUrl}/user/balance";

        $params = ['api_key' => $this->apiKey];

        return $this->makeRequest('GET', $url, $params);
    }

    private function makeRequest($method, $url, $params)
    {
        $ch = curl_init();

        if ($method === 'GET') {
            $url .= '?' . http_build_query($params);
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        };
        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }
}
