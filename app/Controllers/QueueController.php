<?php
namespace App\Controllers;

use App\Libraries\RedisLibrary;
use App\Jobs\Jobs;

class QueueController extends BaseController
{
    public function addToQueue(): string
    {
        $redis = new RedisLibrary();
        $job = new Jobs(['job' => 'data']);
        $redis->getRedis()->rpush('jobs', serialize($job));
        return 'Job added to queue';
    }

    public function processQueue(): string
    {
        $redis = new RedisLibrary();
        while ($job = $redis->getRedis()->lpop('jobs')) {
            $job = unserialize($job);
            $job->handle();
        }
        return 'Queue processed';
    }
}
