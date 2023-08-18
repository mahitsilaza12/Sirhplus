<?php

namespace Sirhplus\Api\User\Application\SendEmailResetPassword;

use Sirhplus\Shared\Domain\Event\EmailEventInterface;
use Sirhplus\Shared\Domain\Model\EmailModel;
use Sirhplus\Shared\Domain\Token\GenerateTokenInterface;
use Sirhplus\Shared\Service\ApplicationService;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * class SendEmailResetPassword
 */
final class SendEmailResetPassword implements ApplicationService
{
    /**
     * @param array $payloads
     * @param GenerateTokenInterface $generateToken
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        private array $payloads,
        private readonly GenerateTokenInterface $generateToken,
        private readonly EventDispatcherInterface $dispatcher
    ) {
    }

    /**
     * @param Request $request
     * @return null|Response
     */
    public function execute(Request $request): ?Response
    {
        $this->payloads['email'] = $request->email;
        $token = $this->generateToken->encode($this->payloads);
        $model = (new EmailModel())
            ->to($request->email)
            ->subject('Votre demande de réinitialisation de mot de passe Externes')
            ->template('reset_password/email.html.twig')
            ->context([
                'token' => $token,
            ]);

        $this->dispatcher->dispatch(
            new GenericEvent($model),
            EmailEventInterface::RESET_PASSWORD
        );

        return null;
    }
}
