<?php

namespace Symfony6\Controller\User;

use Sirhplus\Api\User\Application\ResetPassword\ResetPassword;
use Sirhplus\Api\User\Application\ResetPassword\ResetPasswordRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CreateOfferController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\User\Application\ResetPassword\ResetPasswordRequest")
 * @package Symfony6\Controller\User
 */
final class ResetPasswordController
{
    /**
     * @param ResetPasswordRequest $request
     * @param ResetPassword $resetPassword
     * @return JsonResponse
     */
    public function __invoke(
        ResetPasswordRequest $request,
        ResetPassword $resetPassword
    ): JsonResponse {
        try {
            $resetPassword->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Throwable $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], $e->getCode() != 0 ? $e->getCode() : Response::HTTP_BAD_REQUEST);
        }
    }
}
