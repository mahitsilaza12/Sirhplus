<?php

namespace Symfony6\Controller\Parameters\Configuration\CompanyStructure\Team\Create;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Create\CreateTeamInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Create\CreateTeamRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony6\Controller\ApiController;

/**
 * class CreateTeamController
 *
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Create\CreateTeamRequest")
 * @package Symfony6\Controller\Parameters\Configuration\CompanyStructure\Team\Create
 */
#[Route('/team', name: 'create.team', methods: ['POST'])]
final class CreateTeamController extends ApiController
{
    /**
     * Add new team
     * @OA\Response(
     *     response=201,
     *     description="Created"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *              "companyUuid":"string",
     *              "name":"string",
     *         }
     *     )
     * )
     * @OA\Tag(name="Team")
     * @return JsonResponse
     */
    public function __invoke(CreateTeamInterface $service, CreateTeamRequest $request): JsonResponse
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
