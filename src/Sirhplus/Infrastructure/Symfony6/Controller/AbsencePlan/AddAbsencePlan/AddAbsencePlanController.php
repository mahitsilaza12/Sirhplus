<?php

namespace Symfony6\Controller\AbsencePlan\AddAbsencePlan;

use Sirhplus\Api\AbsencePlan\Application\AddAbsencePlan\AddAbsencePlanInterface;
use Sirhplus\Api\AbsencePlan\Application\AddAbsencePlan\AddAbsencePlanRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony6\Controller\ApiController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * class AddTypeAbsenceController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\AbsencePlan\Application\AddAbsencePlan\AddAbsencePlanRequest")
 * @package Symfony6\Controller\AbsencePlan\AddAbsencePlan
 */
#[Route('/absence-plan', name: 'add.absence.plan', methods: ['POST'])]
final class AddAbsencePlanController extends ApiController
{
    /**
     * Add new AbsencePlan
     * @OA\Response(
     *     response=200,
     *     description="Ok"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *                  "name":"string",
     *                  "companyId":"string",
     *         }
     *     )
     * )
     * @OA\Tag(name="AbsencePlan")
     *
     * @param AddAbsencePlanRequest $request
     * @param AddAbsencePlanInterface $service
     * @return JsonResponse
     */
    public function __invoke(AddAbsencePlanRequest $request, AddAbsencePlanInterface $service): JsonResponse
    {
        try {
            $this->validateRequest($request);
            $service->execute($request);
           
           return new JsonResponse([], Response::HTTP_CREATED);
       } catch (\Exception $e) {
           return new JsonResponse([
               'error' => $e->getMessage(),
           ], Response::HTTP_BAD_REQUEST);
       }  
    }
}