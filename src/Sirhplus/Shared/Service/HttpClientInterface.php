<?php

namespace Sirhplus\Shared\Service;

interface HttpClientInterface
{
    /**
     * @param string $method
     * @param string $uri
     * @param array $data
     * @return \Symfony\Contracts\HttpClient\ResponseInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function request(string $method, string $uri, array $data = []);
}