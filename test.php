<?php

require_once __DIR__ . '/vendor/autoload.php';
use welld1990\ApiCrypto\CryptoClient;


/* $client = CryptoClient::getInstance([
    'driver'=>'Aes',
    'driverConfig'=>[
        'out' => 'base64',
        'pwd' => '6b07cb0ae7337a30',
        'iv'     => '1111111111110001'
    ]
]);

$encrypt = $client->encrypt("123231312111");
echo $encrypt .PHP_EOL;
echo $client->decrypt($encrypt); */


$client = CryptoClient::getInstance([
    'driver'=>'Rsa2',
    'driverConfig'=>[
        'out' => 'base64',
        'type' => 'public'
    ]
]);

$encrypt = $client->encrypt("123231312111");
echo $encrypt .PHP_EOL;
echo $client->decrypt($encrypt).PHP_EOL;
echo $encrypt = $client->encrypt("123231312111");