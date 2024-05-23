<?php
namespace Config;

use App\Commands\ProcessEmailQueue;
use CodeIgniter\Config\BaseConfig;
use App\Commands\ProcessQueue;

class Commands extends BaseConfig
{
    public array $commands = [
        'queue:process' => ProcessQueue::class,
        'queue:process-emails' => ProcessEmailQueue::class,
    ];
}
