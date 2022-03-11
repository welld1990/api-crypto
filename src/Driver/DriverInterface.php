<?php
namespace welld1990\ApiCrypto\Driver;

interface DriverInterface
{
    public function encrypt(string $value);
    public function decrypt(string $value);
}