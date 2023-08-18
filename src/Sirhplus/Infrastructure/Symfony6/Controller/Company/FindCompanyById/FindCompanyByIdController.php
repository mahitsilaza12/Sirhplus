<?php

namespace Symfony6\Controller\Company\FindCompanyById;

use Sirhplus\Api\Company\Application\FindCompanyById\FindCompanyByIdInterface;
use Sirhplus\Api\Company\Application\FindCompanyById\FindCompanyByIdRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

#[Route('/company/{uuid}', name: 'find.company', methods: ['GET'])]
class FindCompanyByIdController
{
    /**
     * Find Company by uuid.
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *    @OA\JsonContent(
     *         example={
     *   "id":"string",
     *   "information":{
     *          "name":"string",
     *          "logo":"string",
     *          "createdAt":"string",
     *          "effective":"integer",
     *          "silegalStructureren":"string",
     *          "sales":"integer",
     *          "address":"string",
     *          "phone":"string",
     *          "website":"string"
     *     },
     *      "identification":{
     *                  "siren":"String",
     *                  "siret":"String",
     *                  "tva":"String",
     *                  "activity":{
     *                              "sector":"String",
     *                              "code":"String",
     *                              },            
     *                  "collectiveAgreement":{
     *                              "details":"String",
     *                              "idcc":"String",
     *                              }, 
     *                  "organism":{
     *                              "provisioning":"String",
     *                              "healthComplementary":"String",
     *                              "pensionFund":"String",
     *                              } 
     *                   },
     *      "others":{
     *                  "leadingStatus":"string",
     *                  "schedule":{
     *                         "start":{
     *                              "date":"String",
     *                              "timezone_type":"String",
     *                              "timezone":"String",
     *                              }, 
     * 
     *                         "end":{
     *                              "date":"String",
     *                              "timezone_type":"String",
     *                              "timezone":"String",
     *                              },
     *                              } ,
     *                  "assignment":"string"
     *                   }
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Find company by uuid",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="Company")
     * @Security(name="Bearer")
     */
    public function __invoke(
        string $uuid,
        FindCompanyByIdRequest $request,
        FindCompanyByIdInterface $service
    ): JsonResponse {
        try {
            $request->setId($uuid);
            $response = $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], $e->getCode() != 0 ? $e->getCode() : Response::HTTP_BAD_REQUEST);
        }
    }
}
