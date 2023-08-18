<?php

namespace Symfony6\Controller\Parameters\Configuration\CompanyStructure\Site\Create;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Create\CreateSiteInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Create\CreateSiteRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony6\Controller\ApiController;

/**
 * class CreateSiteController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Create\CreateSiteRequest")
 * @package Symfony6\Controller\Parameters\Configuration\CompanyStructure\Site\Create
 */
#[Route('/site', name: 'create.site', methods: ['POST'])]
final class CreateSiteController extends ApiController
{
    /**
     * Add new site
     * @OA\Response(
     *     response=201,
     *     description="Ok"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *                  "companyUuid":"string",
     *                  "name":"string",
     *         }
     *     )
     * )
     * @OA\Tag(name="Site")
     * @param CreateSiteInterface $service
     * @param CreateSiteRequest $request
     * @return JsonResponse
     */
    public function __invoke(CreateSiteInterface $service, CreateSiteRequest $request): JsonResponse
    {
        try {
            $this->validateRequest($request);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
