<?php

namespace Symfony6\Controller\User;

use Sirhplus\Api\User\Application\SendEmailResetPassword\SendEmailResetPassword;
use Sirhplus\Api\User\Application\SendEmailResetPassword\SendEmailResetPasswordRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SendEmailResetPasswordController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\User\Application\SendEmailResetPassword\SendEmailResetPasswordRequest")
 * @package Symfony6\Controller\User
 */
final class SendEmailResetPasswordController
{
    public function __invoke(
        SendEmailResetPasswordRequest $request,
        SendEmailResetPassword $sendEmailResetPassword
    ) {
        try {
            $sendEmailResetPassword->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
