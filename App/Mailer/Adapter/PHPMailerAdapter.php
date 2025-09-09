<?php

namespace App\Mailer\Adapter;

use PHPMailer\PHPMailer\SMTP;
use App\Mailer\MailerInterface;
use App\Mailer\MailerCredentials;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class PHPMailerAdapter implements MailerInterface
{
    private PHPMailer $phpMailer;
    private MailerCredentials $credentials;

    public function __construct(MailerCredentials $credentials)
    {
        $this->credentials = $credentials;
        $this->phpMailer = new PHPMailer(true);
        $this->configure();
    }

    private function configure(): void
    {
        $this->phpMailer->isSMTP();
        $this->phpMailer->SMTPAuth = true;
        $this->phpMailer->Host = $this->credentials->HOST;
        $this->phpMailer->Username = $this->credentials->USERNAME;
        $this->phpMailer->Password = $this->credentials->PASSWORD;
        $this->phpMailer->Port = $this->credentials->PORT;
        $this->phpMailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->phpMailer->SMTPDebug = SMTP::DEBUG_OFF;
    }

    public function send(): bool
    {
        return $this->phpMailer->send();
        return false;
    }

    public function isHTML(): void
    {
        $this->phpMailer->isHTML();
    }

    public function isSMTP(): void
    {
        $this->phpMailer->isSMTP();
    }

    public function subject(string $subject): void
    {
        $this->phpMailer->Subject = $subject;
    }

    public function body(string $body, bool $isHtml = true): void
    {
        $this->phpMailer->isHTML($isHtml);
        $this->phpMailer->Body = $body;

        if ($isHtml) {
            $this->phpMailer->AltBody = strip_tags($body);
        }
    }

    public function priority(int $priority): void
    {
        $this->phpMailer->Priority = $priority;
    }

    public function from(string $email, string $name = ''): void
    {
        $this->phpMailer->setFrom($email, $name);
    }

    public function addAddress(string $email, string $name = ''): void
    {
        $this->phpMailer->addAddress($email, $name);
    }

    public function addAttachment(string $path, string $filename = ''): void
    {
        $this->phpMailer->addAttachment($path, $filename);
    }
}
