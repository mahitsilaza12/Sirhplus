<?php

namespace Symfony6\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Sirhplus\Shared\Service\MailerInterface;

/**
 * class AbstractNotifyEmailSubscriber
 */
abstract class AbstractNotifyEmailSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly MailerInterface $mailer)
    {
    }

    public function notify(object $object): void
    {
        $this->mailer->send($object);
    }
}
