<?php

namespace Symfony6\Controller\AbsencePlan\CollectionAssignSalaryAbsencePlan;

use Sirhplus\Api\AbsencePlan\Application\CollectionAssignedSalaryAbsencePlan\CollectionAssignedSalaryAbsencePlanInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/absence-plan/{uuid}/assigned-salaries-absences', name: 'absence.assigned.salariess', methods: ['GET'])]
final class FindAllAssignSalaryAbsencePlanController
{
     /**
     * @param string $uuid
     * @param CollectionAssignedSalaryAbsencePlanInterface $service
     * @param CollectionAssignSalaryAbsencePlanRequestData $requestData
     * @return JsonResponse
     */
    public function __invoke( string $uuid, CollectionAssignedSalaryAbsencePlanInterface $service, CollectionAssignSalaryAbsencePlanRequestData $requestData): JsonResponse
    {
        try {
            $requestData->setUuid($uuid);
            $response = $service->execute($requestData);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
            } catch(\Exception $e) {
                return new JsonResponse([
                    'error' => $e->getMessage(),
                ],Response::HTTP_BAD_REQUEST);
            }         
    }
}