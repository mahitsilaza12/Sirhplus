<?php

namespace Sirhplus\Api\User\Application\GetAdministrators;

use Sirhplus\Api\User\Domain\UserResultSet;
use Sirhplus\Shared\Service\Response;

final class GetAdministratorResponse implements Response
{
    public function __construct(private readonly UserResultSet $resultSet)
    {
    }

    public function getContent(): array
    {
        return array_map(function ($value) {
            return [
                'uuid' => $value['id']->toRfc4122(),
                "firstName" => $value['firstName'],
                "lastName" => $value['lastName'],
                "picture" => $value['logo'],
            ];
        }, $this->resultSet->getData());
    }
}
