<?php

namespace Sirhplus\Shared\Infrastructure\Mailer;

use Sirhplus\Shared\Domain\Model\EmailModel;
use Sirhplus\Shared\Service\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface as SymfonyMailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

/**
 * class SymfonyMailer
 *
 * @package Sirhplus\Shared\Infrastructure\Mailer
 */
final class SymfonyMailer implements MailerInterface
{
    /**
     * @param SymfonyMailerInterface $mailer
     */
    public function __construct(private readonly SymfonyMailerInterface $mailer)
    {
    }

    /**
     * @param EmailModel $model
     * @return void
     * @throws TransportExceptionInterface
     */
    public function send(EmailModel $model): void
    {
        $email = (new TemplatedEmail())
            ->to(new Address($model->to))
            ->subject($model->subject)
            ->htmlTemplate($model->template)
            ->context($model->context);

        $this->mailer->send($email);
    }
}
