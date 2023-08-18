<?php

namespace Sirhplus\Shared\Service;

interface GetCurrentUserInterface
{
    /**
     * @return object|null
     */
    public function getCurrentUser(): ?object;
}
