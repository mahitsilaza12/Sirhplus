<?php

namespace Sirhplus\Api\HourlyRegime\Application\FindHourlyRegimeById;

use Sirhplus\Shared\Service\Response;

final class ShowHourlyRegeimeByIdResponse implements Response
{
    /**
     * @var array
     */
    private array $data = [];

    /**
     * @param object $object
     */
    public function __construct(private readonly object $object)
    {
        $this->mapping();
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->data;
    }

    /**
     * @return void
     */
    public function mapping(): void
    {
        $this->data = [
            'hourlyRegime' => [
                'name' => $this->object->getName(),
                'companyUuid' => $this->object->getCompany()->getId(),
            ]
        ];
    }
}