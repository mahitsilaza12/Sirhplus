<?php

namespace Sirhplus\Api\Company\Application\UpdatePicture;

use Sirhplus\Shared\Service\Request;

final class UpdatePictureRequest implements Request
{
    public function __construct(public string $logo, public string $companyUuid = '')
    {
    }

    /**
     * @return string
     */
    public function companyUuid(): string
    {
        return $this->companyUuid;
    }

    /**
     * @param string $companyUuid
     */
    public function setCompanyUuid(string $companyUuid): void
    {
        $this->companyUuid = $companyUuid;
    }
}
