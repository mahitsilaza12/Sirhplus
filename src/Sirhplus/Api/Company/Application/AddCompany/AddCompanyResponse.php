<?php

namespace Sirhplus\Api\Company\Application\AddCompany;

use Sirhplus\Shared\Service\Response;

/**
 * class AddCompanyResponse
 */
final class AddCompanyResponse implements Response
{
    /**
     * @param object $object
     */
    public function __construct(private readonly object $object)
    {
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return [
            'id' => $this->object->getId()->toRfc4122(),
        ];
    }
}
