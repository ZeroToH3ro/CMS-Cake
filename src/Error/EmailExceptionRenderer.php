<?php

namespace App\Error;

use Cake\Error\BaseErrorHandler;
use Cake\Error\ExceptionRenderer;
use Cake\Mailer\Mailer;
use Throwable;

class EmailExceptionRenderer extends ExceptionRenderer
{
    public function render(): \Psr\Http\Message\ResponseInterface
    {
        // Send an email notification
        $this->sendErrorEmail($this->error);
        return parent::render();
    }
    protected function sendErrorEmail(\Throwable $error): void
    {
        $mailer = new Mailer('default');
        $mailer
            ->setTo('admin@example.com') // Replace with your recipient email address
            ->setSubject('Error Notification')
            ->deliver("An error occurred: " . $error->getMessage() . "\nStack trace:\n" . $error->getTraceAsString());
    }
}
