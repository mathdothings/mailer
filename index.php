<?php

define('BASEPATH', __DIR__);

use App\Mailer\Adapter\PHPMailerAdapter;
use App\Mailer\MailerCredentials;
use App\Mailer\WebmailMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';

try {
    $mail = new WebmailMailer(
        new PHPMailerAdapter(
            new MailerCredentials()
        )
    );

    $mail->from('jhonata@csmti.com.br', 'Jhonata - CSM');
    $mail->addAddress('jhonata.prodrigues@gmail.com', 'Jhonata');
    $mail->priority(1);
    $mail->isHTML(true);
    $mail->subject('Notification Testing');
    $mail->body('This is notification priority check for smartphone notifications <b>in bold!</b>');
    $mail->send();

    echo 'Success!' . PHP_EOL;
} catch (Exception $exception) {
    echo "Fail: Mailer: {$exception->getMessage()}";
}
