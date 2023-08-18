<?php

namespace Symfony6\Controller\HourlyRegime\CollectionAssignedSalaryByHourlyRegime;

use Sirhplus\Api\HourlyRegime\Application\CollectionAssignedSalaryByHourlyRegime\CollectionAssignedSalaryByHourlyRegimeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/hourly-regime/{uuid}/assigned-salariess', name: 'hourly.assigned.salaries', methods: ['GET'])]
final class FindAllAssignedSalaryByHourlyRegimeController
{
    
    /**
     *
     * @param string $uuid
     * @param CollectionAssignedSalaryByHourlyRegimeInterface $service
     * @param FindAllAssignedSalaryByHourlyRegimeRequestData $requestData
     * @return JsonResponse
     */
    public function __invoke(string $uuid, CollectionAssignedSalaryByHourlyRegimeInterface $service, FindAllAssignedSalaryByHourlyRegimeRequestData $requestData): JsonResponse
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