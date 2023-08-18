<?php

namespace Symfony6\Security\Http\Authentication;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony6\Entity\Company;

/**
 * class AuthenticationSuccessHandler
 *
 * @package Symfony6\Security\Http\Authentication
 */
final class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    public function __construct(
        private readonly JWTTokenManagerInterface $jwtManager,
        private readonly EventDispatcherInterface $dispatcher
    ) {
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        return $this->handleAuthenticationSuccess($token->getUser());
    }

    /**
     * @param UserInterface $user
     * @param $jwt
     * @return Response
     */
    private function handleAuthenticationSuccess(UserInterface $user, $jwt = null): Response
    {
        if (null === $jwt) {
            $jwt = $this->jwtManager->create($user);
        }

        /** @var Company $company */
        $company = $user->getCompany();
        $response = new JWTAuthenticationSuccessResponse($jwt);
        $event = new AuthenticationSuccessEvent(
            [
                'token' => $jwt,
                'user' => [
                    'email' => $user->getEmail(),
                    'roles' => $user->getRoles(),
                ],
                'company' => [
                    'uuid' => $company->getId()->toRfc4122(),
                    'name' => $company->getName(),
                    'logo' => $company->getLogo(),
                ]
            ],
            $user, $response
        );

        $this->dispatcher->dispatch($event, Events::AUTHENTICATION_SUCCESS);
        $responseData = $event->getData();

        if ($responseData) {
            $response->setData($responseData);
        } else {
            $response->setStatusCode(Response::HTTP_NO_CONTENT);
        }

        return $response;
    }
}
