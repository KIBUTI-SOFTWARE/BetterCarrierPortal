<?php
namespace App\Jobs;

use CodeIgniter\Email\Email;
use Config\Email as EmailConfig;
use App\Libraries\RedisQueueLibrary;
use App\Libraries\MongoQueueLibrary;

class SendEmailJob
{
    protected $to;
    protected $subject;
    protected $message;
    protected mixed $retries;
    protected string $queue = "email_queues";

    const MAX_RETRIES = 3;

    public function __construct($to, $subject, $message, $retries = 0)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->retries = $retries;
    }

    public function handle(): void
    {
        $emailConfig = new EmailConfig();
        $email = \Config\Services::email();
        $email->initialize($emailConfig);
        $email->setTo($this->to);
        $email->setSubject($this->subject);
        $email->setMessage($this->message);

        if (!$email->send()) {
            log_message('error', 'Failed to send email to ' . $this->to. 'Reason: '.PHP_EOL.  $email->printDebugger());
            $this->retry();
        }
    }

    protected function retry(): void
    {
        if ($this->retries < self::MAX_RETRIES) {
            $this->retries++;
            log_message('error', 'Retrying email to ' . $this->to . ' (' . $this->retries . '/' . self::MAX_RETRIES . ')');

            $job = [
                'to' => $this->to,
                'subject' => $this->subject,
                'message' => $this->message,
                'retries' => $this->retries
            ];

            $redisQueue = new RedisQueueLibrary();
            $redisQueue->push($this->queue, $job);

            $mongoQueue = new MongoQueueLibrary();
            $mongoQueue->push($job);
        } else {
            log_message('error', 'Max retries reached for email to ' . $this->to);
        }
    }
}
