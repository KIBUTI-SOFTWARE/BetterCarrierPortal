<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;
use App\Commands\ProcessQueue;

class Commands extends BaseConfig
{
    public array $commands = [
        'queue:process' => ProcessQueue::class,
    ];
}
