<?php
namespace App\Libraries;

use Predis\Client;

class RedisLibrary
{
    protected Client $redis;

    public function __construct()
    {
        $parameters = [
            'scheme' => 'tcp',
            'host'   => getenv('redis.host'),
            'port'   => getenv('redis.port'),
        ];

        if (!empty(getenv('redis.password'))) {
            $parameters['password'] = getenv('redis.password');
        }

        $this->redis = new Client($parameters);
    }

    public function getRedis(): Client
    {
        return $this->redis;
    }
}

