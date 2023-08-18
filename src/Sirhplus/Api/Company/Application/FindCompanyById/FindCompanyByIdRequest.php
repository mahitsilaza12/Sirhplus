<?php

namespace Sirhplus\Api\Company\Application\FindCompanyById;

use Sirhplus\Shared\Service\Request;

final class FindCompanyByIdRequest implements Request
{
    /**
     * Undocumented function
     *
     * @param string $uuid
     */
    public function __construct(public string $uuid = '')
    {
    }

    public function setId(string $uuid) :FindCompanyByIdRequest
    {
        $this->uuid = $uuid;

        return $this; 
    }
}
