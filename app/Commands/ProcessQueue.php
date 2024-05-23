<?php
namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Libraries\RedisLibrary;

class ProcessQueue extends BaseCommand
{
    protected $group       = 'Queue';
    protected $name        = 'queue:process';
    protected $description = 'Process the Redis queue';

    public function run(array $params)
    {
        $redis = new RedisLibrary();
        while (true) {
            while ($job = $redis->getRedis()->lpop('jobs')) {
                $job = unserialize($job);
                $job->handle();
            }
            sleep(1); // Sleep for a second to avoid busy-wait
        }
    }
}
