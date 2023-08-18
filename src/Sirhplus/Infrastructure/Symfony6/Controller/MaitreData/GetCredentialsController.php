<?php

namespace Symfony6\Controller\MaitreData;

use Sirhplus\Shared\Service\HttpClientInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

#[Route('/maitredata/getcredentials', name: 'maitredata.getcredentials', methods: ['POST'])]
final class GetCredentialsController
{
    /**
     * Get Credentials MaitreData
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *             "client_id": "integer",
     *             "client_secret": "string",
     *             "username": "string",
     *             "password": "string",
     *             "scope": "string"
     *         }
     *     )
     * )
     * @param HttpClientInterface $httpClient
     * @param array $data
     * @param string $uri
     * @return Response
     */
    public function  __invoke(HttpClientInterface $httpClient, array $data, string $uri): Response
    {
        try {
            $data = [
                'client_id' => $data[0]['client_id'],
                'client_secret' => $data[1]['client_secret'],
                'username' => $data[2]['username'],
                'password' => $data[3]['password'],
                'scope' => $data[4]['scope'],
            ];

            $response= $httpClient->request(Request::METHOD_POST, $uri, $data);

           return new Response($response->getContent());
        } catch (\Exception $e) {
            return new JsonResponse(
                [
                  'error' => $e->getMessage()
                ]
                  ,Response::HTTP_BAD_REQUEST
            );
        }
    }
}
