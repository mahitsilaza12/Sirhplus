<?php

namespace Symfony6\Controller\AbsencePlan\EditAbsencePlan;

use Sirhplus\Api\AbsencePlan\Application\EditAbsencePlan\EditAbsencePlanInterface;
use Sirhplus\Api\AbsencePlan\Application\EditAbsencePlan\EditAbsencePlanRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony6\Controller\ApiController;


/**
 * class EditAbsencePlanController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\AbsencePlan\Application\EditAbsencePlan\EditAbsencePlanRequest")
 * @package Symfony6\Controller\AbsencePlan\EditAbsencePlan
 */
#[Route('/absence-plan/{uuid}', name: 'edit.absence.plan', methods: ['PATCH'])]
final class EditAbsencePlanController extends ApiController
{

   /**
     * Edit AbsencePlan by uuid
     *
     * @OA\Response(
     *     response=204,
     *     description="No Content"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *             "name":"String"
     *         }
     *     )
     * )
     * @OA\Tag(name="AbsencePlan")
     *
     * @param string $uuid
     * @param EditAbsencePlanRequest $request
     * @param EditAbsencePlanInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, EditAbsencePlanRequest $request, EditAbsencePlanInterface $service): JsonResponse
    {
        try {
            $this->validateRequest($request);
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