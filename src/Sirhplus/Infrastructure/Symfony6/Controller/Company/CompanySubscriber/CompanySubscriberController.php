<?php

namespace Symfony6\Controller\Company\CompanySubscriber;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sirhplus\Api\Company\Application\CompanySubscriber\CompanySubscriberInterface;
use Sirhplus\Api\Company\Application\CompanySubscriber\CompanySubscriberRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * Class CompanySubscriberController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Company\Application\CompanySubscriber\CompanySubscriberRequest")
 * @package Symfony6\Controller\Company\CompanySubscriber
 */
#[Route('/company/{uuid}/subscription', name: 'company.subscription', methods: ['PATCH'])]
final class CompanySubscriberController
{
    /**
     * Company subscribe an subscription
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *      @OA\JsonContent(
     *        @OA\Property( type = "string", property = "uuid"),
     *        @OA\Property( type = "string", property = "subscriptionUuid")
     *      )
     * )
     * @OA\RequestBody(
     *     required=true,
     * @OA\JsonContent(
     *         example={
     *          "subscriptionUuid" : "string"
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Subscriber company",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="Company")
     * @Security(name="Bearer")
     * 
     * @param string $uuid
     * @param CompanySubscriberRequest $request
     * @param CompanySubscriberInterface $service
     * @return JsonResponse
     */
    public function __invoke(
        string                     $uuid,
        CompanySubscriberRequest   $request,
        CompanySubscriberInterface $service
    ): JsonResponse {
        try {
            $request->setUuid($uuid);
            $service->execute($request);
            
            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
