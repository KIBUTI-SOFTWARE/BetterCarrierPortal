<?php
namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Libraries\RedisQueueLibrary;
use App\Libraries\MongoQueueLibrary;

class ProcessEmailQueue extends BaseCommand
{
    protected $group       = 'Queue';
    protected $name        = 'queue:process-emails';
    protected $description = 'Process the email queue';
    protected string $queue = "email_queues";

    public function run(array $params)
    {
        $redisQueue = new RedisQueueLibrary();
        $mongoQueue = new MongoQueueLibrary();

        while (true) {
            // Try to get a job from Redis first
            $job = $redisQueue->pop($this->queue);

            // If no job found in Redis, check MongoDB
            if (!$job) {
                $job = $mongoQueue->pop();
            }

            if ($job) {
                $emailJob = new \App\Jobs\SendEmailJob(
                    $job['to'],
                    $job['subject'],
                    $job['message'],
                    $job['retries']
                );
                $emailJob->handle();
            } else {
                sleep(1); // Sleep for a second to avoid busy-wait
            }
        }
    }
}
