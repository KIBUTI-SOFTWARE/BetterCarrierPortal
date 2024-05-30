<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use DateTime;
use Exception;

/**
 * My Defined Functions.
 */
class MyFunctions extends BaseConfig
{
    /**
     * @throws Exception
     */

    public static function generateID(): string
    {
        $date = date('ymd');
        $rand = substr(random_int(1000000, 9999999), 0, 4);
        $queryTime = substr($_SERVER["REQUEST_TIME_FLOAT"], -5, 5);

        $queryT = str_replace('.', '0', $queryTime);
        return $date . str_shuffle($rand) . ($queryT);
    }

    public static function generateValidationLink(): string
    {
        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($set), 0, 24);
    }

    public static function sendVerificationEmail($subject, $message, $sent_to): string
    {
        $email = \Config\Services::email();

        $email->setFrom($_ENV['system_email'], $_ENV['system_name']);
        $email->setTo($sent_to);

        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            return 'SUCCESS';
        }

        return $email->printDebugger();
    }

    public static function sendEmail($sendTo, $message): string
    {
        $email = \Config\Services::email();

        $email->setFrom('sandbox@nollaafrica.com', 'UniSMS Support');
        $email->setTo($sendTo);
//        $email->setCC('another@another-example.com');
//        $email->setBCC('them@their-example.com');

        $email->setSubject('PASSWORD RECOVERY OTP');
        $email->setMessage("$message");

        if ($email->send()) {
            return 'SUCCESS';
        }

        return $email->printDebugger();
    }

    public static function sendEmailSingle($recipient, $subject, $message, $sender = 'NULL', $attachment = 'NULL'): string
    {
        $email = \Config\Services::email();
        $logger = service('logger');

        $email->setFrom('sandbox@nollaafrica.com', 'UniSMS Support');
        $email->setTo($recipient);
        if ($sender !== 'NULL') {
            $email->setCC($sender);
        }

        $email->setSubject($subject);
        $email->setMessage($message);
        if ($attachment !== 'NULL') {
            $email->attach($attachment);
        }

        if ($email->send()) {
            $logger->info("Email sent to $recipient");
            $email->clear();
            return 'SUCCESS';
        }
        $logger->error("Failed to send email to $recipient");
        return $logger->error("Failed to send email to $recipient");
    }

    /**
     * @param $phoneNumber  10-Digit Phone Number in the format 0xxxxxxxxx e.g. 0745377504
     * @return string
     */
    public static function getMNO($phoneNumber): string
    {
        // Check if the phone number is valid (10 characters starting with 0)
        if (preg_match('/^0[0-9]{9}$/', $phoneNumber)) {
            // Extract the first three digits of the phone number
            $prefix = substr($phoneNumber, 1, 2);

            // Determine the MNO based on the prefix
            switch ($prefix) {
                case '071':
                case '065':
                case '067':
                case '077':
                    return 'Tigo';
                case '073':
                    return 'TTCL';
                case '074':
                case '075':
                case '076':
                    return 'Vodacom';
                case '078':
                case '068':
                case '069':
                    return 'Airtel';
                case '066':
                    return 'Smile';
                case '061':
                case '062':
                    return 'Halopesa';
                case '063':
                    return 'Mkulima';
                case '064':
                    return 'Wiafrica';
                case '072':
                    return 'Mo Mobile';
                default:
                    return 'Unknown MNO';
            }
        } else {
            // Phone number is not valid
            return 'Invalid Phone Number';
        }
    }

    public static function getDate(): string
    {
        return date('Y-m-d\TH:i:s.uP');
    }

    /**
     * @throws Exception
     */
    public static function timeAgo($timestamp): string
    {
        // Create DateTime objects for the given timestamp and the current time
        $time = new DateTime($timestamp);
        $now = new DateTime();

        // Calculate the difference between the current time and the given timestamp
        $interval = $now->diff($time);

        // Return the difference as a human-readable string
        if ($interval->y > 0) {
            return $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
        } elseif ($interval->m > 0) {
            return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
        } elseif ($interval->d > 0) {
            return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
        } elseif ($interval->h > 0) {
            return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
        } elseif ($interval->i > 0) {
            return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
        } else {
            return $interval->s . ' second' . ($interval->s > 1 ? 's' : '') . ' ago';
        }
    }

    public static function getUserLevel($user_level): string
    {
        return match ($user_level) {
            '1' => 'Super Admin',
            '2' => 'System Admin',
            '3' => 'Employer/Talent Seeker',
            '4' => 'Talent/Job Seeker',
            default => 'Undefined Level',
        };
    }

    public static function getIndustry($industry): string
    {
        return match ($industry) {
            '1' => 'IT',
            '2' => 'Energy',
            default => 'Undefined Industry',
        };
    }
}