<?php

namespace Symfony6\EventSubscriber\User\ResetPassword;

use Symfony6\EventSubscriber\AbstractNotifyEmailSubscriber;
use Sirhplus\Shared\Domain\Event\EmailEventInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * class ResetEmailSubscriber
 * @package Symfony6\EventSubscriber\User\ResetPassword
 */
final class ResetEmailSubscriber extends AbstractNotifyEmailSubscriber
{
    public static function getSubscribedEvents()
    {
        return [
            EmailEventInterface::RESET_PASSWORD => 'onNotifyResetPassword'
        ];
    }

    /**
     * @param GenericEvent $event
     * @return void
     */
    public function onNotifyResetPassword(GenericEvent $event): void
    {
        $this->notify($event->getSubject());
    }
}
