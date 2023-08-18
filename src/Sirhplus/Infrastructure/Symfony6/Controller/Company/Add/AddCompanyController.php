<?php

namespace Symfony6\Controller\Company\Add;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Company\Application\AddCompany\AddCompany;
use Sirhplus\Api\Company\Application\AddCompany\AddCompanyRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as SecurityInterface;

/**
 * Class AddCompanyController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Company\Application\AddCompany\AddCompanyRequest")
 * @package Symfony6\Controller\Company\Add
 */
#[Route('/company', name: 'add.company', methods: ['POST'])]
final class AddCompanyController
{
    /**
     * Add company
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *     @OA\JsonContent(
     *         example={
     *             "id":"string"
     *         }
     *     )
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *      "general":{
     *                  "name":"String",
     *                  "logo":"File",
     *                  "legalStructure":"String",
     *                  "socialReason":"String",
     *                  "createdAt":"Y-m-d",
     *                  "sales":"String",
     *                  "address":"String",
     *                  "postalCode": "String",
     *                  "city":"String",
     *                  "site":"String",
     *                  "phone":"String"
     *                   },
     *      "identification":{
     *                  "siren":"String",
     *                  "siret":"String",
     *                  "tva":"String",
     *                  "rcs":"String",
     *                  "activity":{
     *                              "sector":"String",
     *                               "code":"String"
     *                              },
     *                  "collectiveAgreement":{
     *                              "details":"String",
     *                              "idcc":"String"
     *                                          },
     *                  "organism":{
     *                              "provisioning":"String",
     *                              "healthComplementary":"String",
     *                              "pensionFund":"String"
     *                              }
     *                   },
     *        "others":{
     *                  "leadingStatus": "String",
     *                  "schedule": "string",
     *                  "assignment":"String"
     *                 }
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Add company",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="Company")
     * @SecurityInterface("hasAccessRight(['ROLE_SUPER_ADMIN'])")
     */
    public function __invoke(AddCompanyRequest $request, AddCompany $addCompany)
    {
        try {
            $response = $addCompany->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
