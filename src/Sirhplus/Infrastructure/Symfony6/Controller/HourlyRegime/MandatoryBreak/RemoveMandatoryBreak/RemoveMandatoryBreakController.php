<?php

namespace Symfony6\Controller\HourlyRegime\MandatoryBreak\RemoveMandatoryBreak;

use Sirhplus\Api\MandatoryBreak\Application\RemoveMandatoryBreak\RemoveMandatoryBreakInterface;
use Sirhplus\Api\MandatoryBreak\Application\RemoveMandatoryBreak\RemoveMandatoryBreakRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;

#[Route('/hourlyRegime/{hourlyRegimeId}/mandatoryBreak/{uuid}', name: 'remove.mandatoryBreak.hourly', methods: ['DELETE'])]
final class RemoveMandatoryBreakController
{

     /** 
     * delete mandatory by hourly regime
     * @OA\Response(
     *     response=204,
     *     description="No Content"
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     *
     *
     * @param integer $id
     * @param RemoveMandatoryBreakRequest $request
     * @param RemoveMandatoryBreakInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, RemoveMandatoryBreakRequest $request, RemoveMandatoryBreakInterface $service) :JsonResponse
    {
        try {
            $request->setId($uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_OK);
        } catch(\Exception $e) {

            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }        
    }
}