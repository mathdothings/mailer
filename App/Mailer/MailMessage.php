<?php

namespace App\Mailer;

class MailMessage
{
    public readonly string $from;
    public readonly string $subject;
    public readonly string $body;
    public readonly array $addresses;
    public readonly int $priority;
}
