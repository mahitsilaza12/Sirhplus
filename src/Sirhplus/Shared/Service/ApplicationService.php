<?php

namespace Sirhplus\Shared\Service;

/**
 * interface ApplicationService
 * @package Sirhplus\Shared\Service
 */
interface ApplicationService
{
    /**
     * @param Request $request
     * @return null|Response
     */
    public function execute(Request $request): ?Response;
}
