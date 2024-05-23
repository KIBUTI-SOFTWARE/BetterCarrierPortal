<?php
namespace App\Libraries;

use Predis\Client as RedisClient;

class RedisQueueLibrary
{
    protected RedisClient $client;

    public function __construct()
    {
        $this->client = new RedisClient([
            'scheme' => 'tcp',
            'host'   => '127.0.0.1',
            'port'   => 6379,
        ]);
    }

    public function push(string $queueName, array $job): void
    {
        $this->client->rpush($queueName, json_encode($job));
    }

    public function pop(string $queueName)
    {
        $job = $this->client->lpop($queueName);
        return $job ? json_decode($job, true) : null;
    }
}
