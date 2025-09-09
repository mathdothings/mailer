<?php

namespace App\Mailer;

use PHPMailer\PHPMailer\SMTP;
use App\Mailer\MailerInterface;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class WebmailMailer implements MailerInterface
{
    private MailerInterface $mail;

    public function __construct(
        MailerInterface $mail
    ) {
        $this->mail = $mail;
        $this->priority();
    }

    public function send(): bool
    {
        try {
            return $this->mail->send();
        } catch (Exception $exception) {
            error_log($exception);
            return false;
        }
    }

    public function subject(string $subject): void
    {
        $this->mail->subject($subject);
    }

    public function body(string $body, bool $isHtml = true): void
    {
        $this->mail->body($body);

        if ($isHtml) {
            $this->mail->isHTML(true);
            // $this->mail->AltBody = strip_tags($body);
        } else {
            $this->mail->isHTML(false);
        }
    }

    public function isHTML(): void
    {
        $this->mail->isHTML();
    }

    public function isSMTP(): void
    {
        $this->mail->isSMTP();
    }

    public function from(string $email, string $name = ''): void
    {
        $this->mail->from($email, $name);
    }

    public function priority(int $priority = 1): void
    {
        $this->mail->priority($priority);
    }

    public function addAddress(string $email, string $name = ''): void
    {
        $this->mail->addAddress($email, $name);
    }

    public function addAttachment(string $path, string $filename = ''): void
    {
        $this->mail->addAttachment($path, $filename);
    }

    private function debug()
    {
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
    }
}
