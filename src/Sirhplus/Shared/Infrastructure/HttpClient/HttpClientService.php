<?php

namespace Sirhplus\Shared\Infrastructure\HttpClient;

use Sirhplus\Shared\Service\HttpClientInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface as SymfonyHttpClientInterface;

class HttpClientService implements HttpClientInterface
{
    public function __construct(private SymfonyHttpClientInterface $httpClient)
    {
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $data
     * @return \Symfony\Contracts\HttpClient\ResponseInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function request(string $method, string $uri, array $data = [])
    {
        return $this->httpClient->request($method,
            $uri,
            [
                'headers' => ['Accept' => 'application/json'],
                'body' => $data
            ]);
    }
}
