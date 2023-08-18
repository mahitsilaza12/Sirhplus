<?php

namespace Sirhplus\Api\Company\Domain;

/**
 * class CompanyHoldingResultSet
 */
final class CompanyHoldingResultSet
{
    /**
     * @param array $data
     */
    public function __construct(private readonly array $data)
    {
    }

    /**
     * @return array
     */
    public function data(): array
    {
        return array_map(function ($value) {
            return [
                'id' => $value->getId(),
                'name' => $value->getName(),
                'logo' => $value->getName(),
                'type' => $value->getParent() ? $value->getParent()->getId() : null,
            ];
        }, $this->data);
    }
}
