<?php

namespace Symfony6\Controller\Company\Contact;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Company\Application\Contact\ContactInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/company/{uuid}/contacts', name: 'company.contact', methods: ['GET'])]
final class ContactController
{
    /**
     * Show all contact by company
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *     @OA\JsonContent(
     *         example={
     *            "data":{
     *               "id": "string",
     *               "lastName": "string",
     *               "firstName": "string",
     *               "function": "string",
     *               "email": "string",
     *               "phoneNumber": "string"
     *            },
     *           "meta":{
     *              "total_page": "integer"
     *           }
     *        }
     *     )
     * )
     * @OA\Tag(name="Company")
     *
     * @param string $uuid
     * @param ContactInterface $service
     * @param GetContactCollectionRequestData $request
     * @return JsonResponse
     */
    public function __invoke(string $uuid, ContactInterface $service, GetContactCollectionRequestData $request): JsonResponse
    {
        try {
            $request->setCompanyUuid($uuid);
            $response = $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
