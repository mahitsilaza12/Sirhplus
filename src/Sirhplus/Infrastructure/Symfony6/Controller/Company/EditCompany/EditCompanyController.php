<?php

namespace Symfony6\Controller\Company\EditCompany;;

use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as SecurityInterface;
use Sirhplus\Api\Company\Application\EditCompany\EditCompany;
use Sirhplus\Api\Company\Application\EditCompany\EditCompanyRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony6\Entity\Company;

/**
 * Class AddCompanyController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Company\Application\EditCompany\EditCompanyRequest")
 * @package Symfony6\Controller\Company\Add
 */
#[Route('/company/{uuid}', name: 'edit.company', methods: ['PUT'])]
final class EditCompanyController
{
    /**
     * Edit company by uuid
     * @OA\Response(
     *      response = "204",
     *      description = "No content",
     *      @OA\JsonContent(
     *        @OA\Property( type = "integer", property = "id", example = "1" ),
     *        @OA\Property( type = "string", property = "name", example = "string"),
     *        @OA\Property( type = "string", property = "logo", example = "string"),
     *        @OA\Property( type = "string", property = "legalStructure", example = "string"),
     *        @OA\Property( type = "string", property = "phoneNumber", example = "string"),
     *        @OA\Property( type = "string", property = "socialReason", example = "string"),
     *        @OA\Property( type = "datetime", property = "createdAt", example = "y-m-d"),
     *        @OA\Property( type = "string", property = "sales", example = "string"),
     *        @OA\Property( type = "string", property = "address", example = "string"),
     *        @OA\Property( type = "string", property = "postalCode", example = "string"),
     *        @OA\Property( type = "string", property = "city", example = "string"),
     *        @OA\Property( type = "string", property = "site", example = "string"),
     *        @OA\Property( type = "string", property = "siren", example = "string"),
     *        @OA\Property( type = "string", property = "siret", example = "string"),
     *        @OA\Property( type = "string", property = "tva", example = "string"),
     *        @OA\Property( type = "string", property = "rcs", example = "string"),
     *        @OA\Property( type = "string", property = "activity", example = "string"),
     *        @OA\Property( type = "string", property = "sector", example = "string"),
     *        @OA\Property( type = "string", property = "code", example = "string"),
     *        @OA\Property( type = "string", property = "details", example = "string"),
     *        @OA\Property( type = "string", property = "idcc", example = "string"),
     *        @OA\Property( type = "string", property = "provisioning", example = "string"),
     *        @OA\Property( type = "string", property = "healthComplementary", example = "string"),
     *        @OA\Property( type = "string", property = "leadingStatus", example = "string"),
     *        @OA\Property( type = "datetime", property = "start", example = "y-m-d"),
     *        @OA\Property( type = "datetime", property = "end", example = "y-m-d"),
     *        @OA\Property( type = "string", property = "assignment", example = "string"),
     *        @OA\Property( type = "string", property = "subscription", example = "string")
     *      )
     * )
     * @OA\RequestBody(
     *     required=true,
     * @OA\JsonContent(
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
     *                  "phoneNumber":"String"
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
     *                  "schedule": "String",
     *                  "assignment":"String"
     *                 }
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Edit company",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="Company")
     * @Security(name="Bearer")
     *
     * @SecurityInterface("hasAccessRight(['ROLE_SUPER_ADMIN'])")
     */
    public function __invoke(string $uuid, EditCompanyRequest $request, EditCompany $editCompany)
    {
        try {
            $request->setUuid($uuid);
            $editCompany->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
