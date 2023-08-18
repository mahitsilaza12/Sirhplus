<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain;

use Sirhplus\Shared\Domain\Exception\DomainError;

/**
 * class SiteNotFound
 */
final class SiteNotFound extends DomainError
{
    /**
     * @param string $uuid
     */
    public function __construct(private readonly string $uuid)
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function errorCode(): string
    {
        return 'site_not_found';
    }

    /**
     * @return string
     */
    protected function errorMessage(): string
    {
        return sprintf('Site <%s> has not been found', $this->uuid);
    }
}
