<?php

namespace Symfony6\Controller\RefreshToken;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use OpenApi\Annotations as OA;

/**
 * class RefreshTokenController
 */
#[Route('/refreshToken', name: 'refreshToken', methods: ['GET'])]
final class RefreshTokenController
{
    /**
     * Refresh Token
     * @OA\Response(
     *     response=200,
     *     description="Response Token",
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Get refresh Token /api/refreshToken",
     *     @OA\Schema(type="string")
     * )
     *
     * @param UserInterface $user
     * @param JWTTokenManagerInterface $JWTTokenManager
     * @return JsonResponse
     */
    public function __invoke(UserInterface $user, JWTTokenManagerInterface $jwtTokenManager)
    {
        try {

            return new JsonResponse(['token' => $jwtTokenManager->create($user)]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
