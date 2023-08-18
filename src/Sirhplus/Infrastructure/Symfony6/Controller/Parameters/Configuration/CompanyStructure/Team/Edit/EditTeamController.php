<?php

namespace Symfony6\Controller\Parameters\Configuration\CompanyStructure\Team\Edit;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Edit\EditTeamInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Edit\EditTeamRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony6\Controller\ApiController;

/**
 * class EditTeamController
 *
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Edit\EditTeamRequest")
 * @package Symfony6\Controller\Parameters\Configuration\CompanyStructure\Team\Create
 */
#[Route('/team/{uuid}', name: 'edit.team', methods: ['PATCH'])]
final class EditTeamController extends ApiController
{
    /**
     * Edit team
     * @OA\Response(
     *     response=204,
     *     description="No content"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *              "name":"string",
     *         }
     *     )
     * )
     * @OA\Tag(name="Team")
     * @param string $uuid
     * @param EditTeamInterface $service
     * @param EditTeamRequest $request
     * @return JsonResponse
     */
    public function __invoke(string $uuid, EditTeamInterface $service, EditTeamRequest $request): JsonResponse
    {
        try {
            $request->setUuid($uuid);
            $this->validateRequest($request);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
