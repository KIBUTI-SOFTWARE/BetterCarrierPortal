<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class Redis extends BaseConfig
{
    public string $host = 'localhost';
    public int $port = 6379;
    public string $password = '';
    public int $database = 0;
}
