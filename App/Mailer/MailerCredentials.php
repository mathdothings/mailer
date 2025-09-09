<?php

namespace App\Mailer;

use Dotenv\Dotenv;
use InvalidArgumentException;

final class MailerCredentials
{
    public readonly string $HOST;
    public readonly string $USERNAME;
    public readonly string $PASSWORD;
    public readonly string $PORT;

    private const REQUIRED_ENV_VARS = [
        'MAILER_HOST',
        'MAILER_USERNAME',
        'MAILER_PASSWORD',
        'MAILER_PORT'
    ];

    public function __construct()
    {
        $env = Dotenv::createImmutable(BASEPATH)->load();
        $this->validateEnvironment($env);

        $this->HOST = $env['MAILER_HOST'];
        $this->USERNAME = $env['MAILER_USERNAME'];
        $this->PASSWORD = $env['MAILER_PASSWORD'];
        $this->PORT = $env['MAILER_PORT'];
    }

    private function validateEnvironment(array $env): void
    {
        foreach (self::REQUIRED_ENV_VARS as $var) {
            if (empty($env[$var])) {
                throw new InvalidArgumentException(
                    sprintf('Missing or empty required environment variable: %s', $var)
                );
            }
        }
    }

    public function toArray(): array
    {
        return [
            'host' => $this->HOST,
            'username' => $this->USERNAME,
            'password' => $this->PASSWORD,
            'port' => $this->PORT
        ];
    }
}
