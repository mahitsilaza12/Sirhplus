<?php

namespace Symfony6\Controller\HourlyRegime\MandatoryBreak\FindMandatoryBreakById;

use Sirhplus\Api\MandatoryBreak\Application\FindMandatoryBreakById\FindMandatoryBreakByIdInterface;
use Sirhplus\Api\MandatoryBreak\Application\FindMandatoryBreakById\FindMandatoryBreakByIdRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;

#[Route('/hourly-regime/{uuid}/mandatory-break/{id}', name: 'find.mandatoryBreak.hourly', methods: ['GET'])]
final class FindMandatoryBreakByIdController
{
    /**
     * Find MandatoryBreakByHourlyRegime by Id.
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     * @OA\JsonContent(
     *         example={
     *                  "name":"String",
     *                  "workingTimes":"String",
     *                  "pause":"String"
     *         }
     *     )
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     * 
     *
     * @param string $id
     * @param FindMandatoryBreakByIdRequest $request
     * @param FindMandatoryBreakByIdInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $id, string $uuid, FindMandatoryBreakByIdRequest $request, FindMandatoryBreakByIdInterface $service) :JsonResponse
    {
        try{
            $request->setId($id);
            $response =  $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch(\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], $e->getCode() != 0 ? $e->getCode() : Response::HTTP_BAD_REQUEST);
            
        }  
    }
}