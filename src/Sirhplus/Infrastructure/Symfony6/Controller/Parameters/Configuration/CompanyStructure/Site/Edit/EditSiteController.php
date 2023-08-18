<?php

namespace Symfony6\Controller\Parameters\Configuration\CompanyStructure\Site\Edit;

use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Edit\EditSiteInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Edit\EditSiteRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony6\Controller\ApiController;

/**
 * class CreateSiteController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Edit\EditSiteRequest")
 * @package Symfony6\Controller\Functions\Add
 */
#[Route('/site/{uuid}', name: 'edit.site', methods: ['PATCH'])]
final class EditSiteController extends ApiController
{
    /**
     * Edit site by uuid
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
     * @OA\Tag(name="Site")
     * @param string $uuid
     * @param EditSiteInterface $service
     * @param EditSiteRequest $request
     * @return JsonResponse
     */
    public function __invoke(string $uuid, EditSiteInterface $service, EditSiteRequest $request): JsonResponse
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
