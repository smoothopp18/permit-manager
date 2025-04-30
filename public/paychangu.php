<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$response = $client->request('POST', 'https://api.paychangu.com/mobile-money/payments/initialize', [
  'body' => '{"mobile_money_operator_ref_id":"20be6c20-adeb-4b5b-a7ba-0769820df4fb"}',
  'headers' => [
    'accept' => 'application/json',
    'content-type' => 'application/json',
  ],
]);

echo $response->getBody();