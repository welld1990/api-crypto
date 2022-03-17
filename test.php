<?php

require_once __DIR__ . '/vendor/autoload.php';
use welld1990\ApiCrypto\CryptoClient;

//公钥
$public_key = <<<EOF
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvkyDRoegUIr2g61ErAbh
iDQyCaEI2EZbersCgx1FOAlCaNrYsUswFBkDVBjqbF9iQxy9LHNEFC7KrK07quQQ
I2ABbHzrr2Kjk9DM48ZiLs9kYSVIDRONgYW8isNgNP/JRg2QU13IfaQqvnobWdUa
ItKynHPkXvZkdVByMfUEhaMwRouGAtSLHsNbuSBN8CWj7v/z//RqGoSH6Gwg5ZRO
8v7to+HHbBx1cNebkRZo4GbBWXB9sLBrzZwzg7b6UeY7CdU/z8PPgsqKsvYuV0oN
RPr+bYpvHoWox7h74JFn3NePLKMHxVZrx6MS9VXupSHWw4qbRY7E6BkcaV3Ti42a
TQIDAQAB
-----END PUBLIC KEY-----
EOF;
//私钥
$private_key = <<<EOF
-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC+TINGh6BQivaD
rUSsBuGINDIJoQjYRlt6uwKDHUU4CUJo2tixSzAUGQNUGOpsX2JDHL0sc0QULsqs
rTuq5BAjYAFsfOuvYqOT0MzjxmIuz2RhJUgNE42BhbyKw2A0/8lGDZBTXch9pCq+
ehtZ1Roi0rKcc+Re9mR1UHIx9QSFozBGi4YC1Isew1u5IE3wJaPu//P/9GoahIfo
bCDllE7y/u2j4cdsHHVw15uRFmjgZsFZcH2wsGvNnDODtvpR5jsJ1T/Pw8+Cyoqy
9i5XSg1E+v5tim8ehajHuHvgkWfc148sowfFVmvHoxL1Ve6lIdbDiptFjsToGRxp
XdOLjZpNAgMBAAECggEAGvO3PAwFdqLX2zp1GXA4DRRnadm26Pq+Bhnqdyt0HEWj
dDpaqnGds5r/T6/fs82mmx685EjHAZzG88HtS3zVlE0KppTixIpR5KOUAUadrUeO
Tfv7wm5cglWwqG6Xd6oqlZNiN4x20uSncSbWLNjzxK7WwTXgyFpZTAxCwDSVmV+O
wyoXRryG4eYrbFkQPJW8F+WoEbcR1NY9MNL+HFXc3+2oeESrYVM5Oz9yaF4DPl51
nA5NrqLgWX+trZ9wlQgeF09mU/WTBohvFW/vcbka5TtU/+dwUyXzUqYpaP+WX90M
yAC1Jme3ZJJ+PBrIqlywsRROT/E14J3FtJIfDpIpgQKBgQDvQ+QmjUyHc6gIOQpz
vjT7P8U3Isqb7sIpTvylxQK8PLaPpniQt+Yph9dn3mFsDW8ZiTOlG8nXFNYLvhmV
PAirO7L75XNKHdWXCgOk6tK/X2Phk2Tf3dek1VUfifsFJsZobzJmpxZjLD/GhbBE
oGSBJdmJ5aHytqXjfvF4hXJL0QKBgQDLm92/vx7xrJ9J8XtjALzYMBdhevI3Tzm8
dAgVmGDHHswUWkUX3o8I0mvigcSb12NwlWJAiIeDHX8TffxSCsJIDqFrl+hLsYjZ
BV5L0Z2DcsuCQhy6Qv0oZDLRW1vgqGcvGGnsU5EDzNCav2GTJoP+W79Q6ayQZDUa
SsshsWbRvQKBgQDeAfbOtslN3ckKaDMElnb+sntB36xz56SNQ9c10YnqM8OJowO3
9ItB+eOrYzKuWgC+hwo+p3wvcAv0NV3zlRLOH8TB6nOBUBGB5i7fdWw7Wj2Jb4Ro
HKYdMj2b2CHs87+h45u2mE8zkjlS8XVPGCxpkT86rrIITeW7I2zXUatuIQKBgH3H
7jdUNCOMRmMBoP3KKN9M5kS8FQICGWLIM25T0gVwixZPpbtXK/mBNFCbZf/4EWAt
iKLhNQXUpPo/rC5qoxasox+6mjCYnjejT1t7RNk9g2cWvHR8ibP4IkSfMaUZo5S+
ekEaZs14K65NaFPlSUlLGGc90/LnVL7HUbGgzCnpAoGBANfpmIIWKsA1sv0xH8g8
RmcsJ21I9UbhHvSoHR31F8rPrcZiLz4KNG3TRjQqW7ynvFlK3pn1fJ09eaby9EQ+
nDDyPrVmVZdKO5xeMPHq71//Bl+bub5lArjP8Libsnq2wLM3D1TDcBnzrR2BDJsO
kfCZy5nwyihlei8PgU2vWRli
-----END PRIVATE KEY-----
EOF;


/************************Rsa******************************/
$client = new CryptoClient([
    'driver'=>'Rsa',
    'driverConfig'=>[
        'out' => 'base64',
        'way' => 'public',
        'public_key' => $public_key,
    ]
]);

$server = CryptoClient::getInstance([
    'driver'=>'Rsa',
    'driverConfig'=>[
        'out' => 'base64',
        'way' => 'private',
        'private_key' => $private_key
    ]
]);

$param = "123231312111123231312111123231312111";
echo '$param:'.$param .PHP_EOL;

//客户端公钥加密
$clientEncrypt = $client->encrypt($param);
echo '$clientEncrypt:'.$clientEncrypt .PHP_EOL;

//服务端私钥解密
$serverDecrypt = $server->decrypt($clientEncrypt);
echo '$serverDecrypt:'.$serverDecrypt.PHP_EOL;

//服务端私钥加密
$serverEncrypt = $server->encrypt($serverDecrypt);
echo '$serverEncrypt:'.$serverEncrypt.PHP_EOL;

//客户端公钥解密
$clientDecrypt = $client->decrypt($serverEncrypt);
echo '$clientDecrypt:'.$clientDecrypt.PHP_EOL;


/************************AES******************************/
$client = new CryptoClient([
     'driver'=>'Aes',
     'driverConfig'=>[
         'out' => 'base64',
         'pwd' => '6b07cb0ae7337a30',
         'iv'     => '1111111111110001'
     ]
 ]);

$encrypt = $client->encrypt($param);

echo 'AES encrypt:'.$encrypt .PHP_EOL;
echo 'AES decrypt:'.$client->decrypt($encrypt);


