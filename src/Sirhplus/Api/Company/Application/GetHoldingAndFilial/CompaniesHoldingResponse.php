<?php

namespace Sirhplus\Api\Company\Application\GetHoldingAndFilial;

use Sirhplus\Shared\Service\Response;

/**
 * class CompaniesHoldingResponse
 */
final class CompaniesHoldingResponse implements Response
{
    /**
     * @param array $data
     */
    public function __construct(public array $data)
    {
    }
}
