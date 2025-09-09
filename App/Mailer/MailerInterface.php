<?php

namespace App\Mailer;

interface MailerInterface
{
    public function send(): bool;
    public function isHTML(): void;
    public function from(string $email, string $name = ''): void;
    public function subject(string $subject): void;
    public function body(string $body, bool $isHtml = true): void;
    public function priority(int $priority): void;
    public function addAddress(string $email, string $name = ''): void;
    public function addAttachment(string $path, string $filename = ''): void;
    public function isSMTP(): void;
}
